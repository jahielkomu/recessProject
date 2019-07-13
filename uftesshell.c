#include <sys/wait.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <arpa/inet.h>
#define PORT 9890
#define BUFFERSIZE 1024
#define clear() printf("\033[H\033[J")

/*
  Function Declarations for builtin shell commands:
 */
int uftes_cd(char **args);
int uftes_help(char **args);
int uftes_exit(char **args);
int uftes_Addmember(char **args);
int uftes_Check_status(char **args);
int uftes_Get_statement(char **args);
/*
  List of builtin commands, followed by their corresponding functions.
 */
char district[30];
char password;
char *builtin_str[] = {
    "cd",
    "help",
    "Addmember",
    "Check_status",
    "Get_statement",
    "exit"};

int (*builtin_func[])(char **) = {
    &uftes_cd,
    &uftes_help,
    &uftes_Addmember,
    &uftes_Check_status,
    &uftes_Get_statement,
    &uftes_exit};

int uftes_num_builtins()
{
    return sizeof(builtin_str) / sizeof(char *);
}
int uftes_cd(char **args)
{
    if (args[1] == NULL)
    {
        fprintf(stderr, "uftes: expected argument to \"cd\"\n");
    }
    else
    {
        if (chdir(args[1]) != 0)
        {
            perror("uftes");
        }
    }
    return 1;
}
int uftes_Addmember(char **args)
{
    char command[] = "Addmember|";
    char lin[300];
    char *line = args[1];
    int clientSocket, ret;
    char req[5] = ".txt";

    struct sockaddr_in serverAddr;
    char buffer[1024];
    // strcpy(buffer, line);
    clientSocket = socket(AF_INET, SOCK_STREAM, 0);
    if (clientSocket < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Client Socket is created.\n");

    memset(&serverAddr, '\0', sizeof(serverAddr));
    serverAddr.sin_family = AF_INET;
    serverAddr.sin_port = htons(PORT);
    serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

    ret = connect(clientSocket, (struct sockaddr *)&serverAddr, sizeof(serverAddr));
    if (ret < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Connected to Server.\n");
    if (strstr(line, req))
    {
        printf("\n\t*****Adding Member***** \t\n");
        send(clientSocket, buffer, strlen(buffer), 0);
        FILE *file;
        file = fopen(line, "r");
        if (file)
        {
            while (!feof(file))
            {
                fgets(lin, 250, file);
                printf("[+]Adding member..... \t\n");
                strcpy(buffer, command);
                strcat(buffer, district);
                strcat(buffer, ",");
                strcat(buffer, lin);
                strcat(buffer, "|");
                send(clientSocket, buffer, strlen(buffer), 0);
                if (strcmp(buffer, ":exit") == 0)
                {
                    close(clientSocket);
                    printf("[-]Disconnected from server.\n");
                    exit(1);
                }

                if (recv(clientSocket, buffer, 1024, 0) < 0)
                {
                    printf("[-]Error in receiving data.\n");
                }
                else
                {
                    printf("Added: \t%s\n", buffer);
                }
            }
        }
        else
        {
            printf("file doesn't exist");
        }
        fclose(file);
    }
    else
    {
        printf("[+]Adding member..... \t\n");
        strcpy(buffer, command);
        strcat(buffer, district);
        strcat(buffer, line);
        strcat(buffer, "|");
        send(clientSocket, buffer, strlen(buffer), 0);

        if (strcmp(buffer, ":exit") == 0)
        {
            close(clientSocket);
            printf("[-]Disconnected from server.\n");
            exit(1);
        }

        if (recv(clientSocket, buffer, 1024, 0) < 0)
        {
            printf("[-]Error in receiving data.\n");
        }
        else
        {
            printf("Added: \t%s\n", buffer);
        }
    }
    close(clientSocket);
    return 1;
}
int uftes_Get_statement(char **args)
{
    int clientSocket, ret;
    struct sockaddr_in serverAddr;
    char buffer[1024];

    clientSocket = socket(AF_INET, SOCK_STREAM, 0);
    if (clientSocket < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Client Socket is created.\n");

    memset(&serverAddr, '\0', sizeof(serverAddr));
    serverAddr.sin_family = AF_INET;
    serverAddr.sin_port = htons(PORT);
    serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

    ret = connect(clientSocket, (struct sockaddr *)&serverAddr, sizeof(serverAddr));
    if (ret < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Connected to Server.\n");

    printf("\n\t*****Getting Statement***** \t\n");
    strcpy(buffer, "Get_statement|");
    strcat(buffer, district);
    send(clientSocket, buffer, strlen(buffer), 0);
    char message[5000];
    if (strcmp(buffer, ":exit") == 0)
    {
        close(clientSocket);
        printf("[-]Disconnected from server.\n");
        exit(1);
    }

    if (recv(clientSocket, message, sizeof(message), 0) < 0)
    {
        printf("[-]Error in receiving data.\n");
    }
    else
    {
        puts(message);
    }
    close(clientSocket);
    return 1;
}
int uftes_Check_status(char **args)
{
    int clientSocket, ret;
    struct sockaddr_in serverAddr;
    char buffer[1024];

    clientSocket = socket(AF_INET, SOCK_STREAM, 0);
    if (clientSocket < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Client Socket is created.\n");

    memset(&serverAddr, '\0', sizeof(serverAddr));
    serverAddr.sin_family = AF_INET;
    serverAddr.sin_port = htons(PORT);
    serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

    ret = connect(clientSocket, (struct sockaddr *)&serverAddr, sizeof(serverAddr));
    if (ret < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Connected to Server.\n");

    printf("\n\t*****Checking Status***** \t\n");
    strcpy(buffer, "Check_status|");
    strcat(buffer, district);
    send(clientSocket, buffer, strlen(buffer), 0);

    if (strcmp(buffer, ":exit") == 0)
    {
        close(clientSocket);
        printf("[-]Disconnected from server.\n");
        exit(1);
    }

    if (recv(clientSocket, buffer, 1024, 0) < 0)
    {
        printf("[-]Error in receiving data.\n");
    }
    else
    {
        printf("Server: \t%s\n", buffer);
    }

    close(clientSocket);
    return 1;
}
/**
   @brief Builtin command: print help.
   @param args List of args.  Not examined.
   @return Always returns 1, to continue executing.
 */
int uftes_help(char **args)
{
    int i;
    printf("United Front For Transformation Enrollment System uftes\n");
    printf("Type program names and arguments, and hit enter.\n");
    printf("The following are built in:\n");

    for (i = 0; i < uftes_num_builtins(); i++)
    {
        printf("  %s\n", builtin_str[i]);
    }

    printf("Use the man command for information on other programs.\n");
    return 1;
}

/**
   @brief Builtin command: exit.
   @param args List of args.  Not examined.
   @return Always returns 0, to terminate execution.
 */
int uftes_exit(char **args)
{
    return 0;
}

/**
  @brief Launch a program and wait for it to terminate.
  @param args Null terminated list of arguments (including program).
  @return Always returns 1, to continue execution.
 */
int uftes_launch(char **args)
{
    pid_t pid;
    int status;

    pid = fork();
    if (pid == 0)
    {
        // Child process
        if (execvp(args[0], args) == -1)
        {
            perror("uftes");
        }
        exit(EXIT_FAILURE);
    }
    else if (pid < 0)
    {
        // Error forking
        perror("uftes");
    }
    else
    {
        // Parent process
        do
        {
            waitpid(pid, &status, WUNTRACED);
        } while (!WIFEXITED(status) && !WIFSIGNALED(status));
    }

    return 1;
}

/**
   @brief Execute shell built-in or launch program.
   @param args Null terminated list of arguments.
   @return 1 if the shell should continue running, 0 if it should terminate
 */
int execute(char **args)
{
    int i;

    if (args[0] == NULL)
    {
        // An empty command was entered.
        return 1;
    }

    for (i = 0; i < uftes_num_builtins(); i++)
    {
        if (strcmp(args[0], builtin_str[i]) == 0)
        {
            return (*builtin_func[i])(args);
        }
    }

    return uftes_launch(args);
}

/**
   @brief Read a line of input from stdin.
   @return The line from stdin.
 */
char *uftes_read(void)
{
    int bufsize = BUFFERSIZE;
    int position = 0;
    char *buffer = malloc(sizeof(char) * bufsize);
    int c;

    if (!buffer)
    {
        fprintf(stderr, "uftes: allocation error\n");
        exit(EXIT_FAILURE);
    }

    while (1)
    {
        // Read a character
        c = getchar();

        if (c == EOF)
        {
            exit(EXIT_SUCCESS);
        }
        else if (c == '\n')
        {
            buffer[position] = '\0';
            return buffer;
        }
        else
        {
            buffer[position] = c;
        }
        position++;

        // If we have exceeded the buffer, reallocate.
        if (position >= bufsize)
        {
            bufsize += BUFFERSIZE;
            buffer = realloc(buffer, bufsize);
            if (!buffer)
            {
                fprintf(stderr, "uftes: allocation error\n");
                exit(EXIT_FAILURE);
            }
        }
    }
}

#define uftes_TOK_BUFSIZE 64
#define uftes_TOK_DELIM " \t\r\n\a"
/**
   @brief Split a line into tokens (very naively).
   @param line The line.
   @return Null-terminated array of tokens.
 */
char **parse(char *line)
{
    int bufsize = uftes_TOK_BUFSIZE, position = 0;
    char **tokens = malloc(bufsize * sizeof(char *));
    char *token, **tokens_backup;

    if (!tokens)
    {
        fprintf(stderr, "uftes: allocation error\n");
        exit(EXIT_FAILURE);
    }

    token = strtok(line, uftes_TOK_DELIM);
    while (token != NULL)
    {
        tokens[position] = token;
        position++;

        if (position >= bufsize)
        {
            bufsize += uftes_TOK_BUFSIZE;
            tokens_backup = tokens;
            tokens = realloc(tokens, bufsize * sizeof(char *));
            if (!tokens)
            {
                free(tokens_backup);
                fprintf(stderr, "uftes: allocation error\n");
                exit(EXIT_FAILURE);
            }
        }

        token = strtok(NULL, uftes_TOK_DELIM);
    }
    tokens[position] = NULL;
    return tokens;
}
void loop(void)
{
    char *line;
    char **args;
    int status;

    do
    {
        printf("\nUFTES# ");
        line = uftes_read();
        args = parse(line);
        status = execute(args);

        free(line);
        free(args);
    } while (status);
}
void init_shell()
{
    clear();
    // uftes_help();
    printf("\n\n\n\n******************"
           "************************");
    printf("\n\n\n\t****WELCOME****");
    printf("\n\n\tT0 UFTES SYSTEM");
    printf("\n\n\n\n*******************"
           "***********************");
    char *username = getenv("USER");
    printf("\n\n\nUSER is: @%s", username);
    // printf("\nType help to see available commands\n");
    int i;
    printf("United Front For Transformation Enrollment System uftes\n");
    printf("Type program names and arguments, and hit enter.\n");
    printf("The following are built in:\n");

    for (i = 0; i < uftes_num_builtins(); i++)
    {
        printf("  %s\n", builtin_str[i]);
    }
    printf("Use the man command for information on other programs.\n");
    printf("Enter district:\t");
    gets(district);
    printf("Enter password:\t");
    password = getchar();
    printf("district %s password %c\n", district, password);
    strcat(district, "|");
}
int main(int argc, char **argv)
{
    // Load config files.
    init_shell();
    // Run command loop.
    loop();

    // Perform any shutdown/cleanup.

    return EXIT_SUCCESS;
}
