#include <sys/wait.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
#include <stdio.h>
#include <string.h>
#include <sys/socket.h>
#include <readline/readline.h>
#include <readline/history.h>
#include <arpa/inet.h>
#include <err.h>
#define PORT 10008
#define BUFFERSIZE 1024
#define CLEAR() printf("\033[H\033[J")

/*
  Function Declarations for builtin shell commands:
 */
int uftes_cd(char **args);
int uftes_help(char **args);
int uftes_exit(char **args);
int uftes_Addmember(char **args);
int uftes_see(char **args);
int uftes_Check_status(char **args);
int uftes_Get_statement(char **args);
int getPass();
/*
  List of builtin commands, followed by their corresponding functions.
 */
char district[30];
char password[2];
char user[30];
char yes_no;
int see = 1;
//                                                                                                                                                         A                      B                 C                  D                  E                   F                 G                  H                   I                J                     K                 L                  M                N->n                0                  P                Q                  R                S                  T                U                  V                W                  X                 Y                 Z
char *key[2][26] = {"A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z", "010101101111101", "110101110101110", "001010100010001", "110101101101110", "111100111100111", "111101111100100", "001010100011010", "101101111101101", "111010010010111", "111010010010110", "101110100110101", "100100100100111", "101111101101101", "010101101101101", "010101101101010", "110101110100100", "010101101111011", "110101110101101", "111100111001111", "111010010010010", "101101101101111", "101101101101010", "101101101111101", "101101010101101", "101101111001111", "111001010100111"};
char *builtin_str[] = {
    "cd",
    "help",
    "Addmember",
    "Check_status",
    "Get_statement",
    "see",
    "exit"};
char **character_name_completion(const char *, int, int);
char *character_name_generator(const char *, int);
char *escape(const char *);
int quote_detector(char *, int);

char *character_names[] = {
    "Addmember",
    "Get_statement",
    "Check_status",
    "help",
    "exit",
    "cd",
    "nano",
    "see",
    NULL};
int (*builtin_func[])(char **) = {
    &uftes_cd,
    &uftes_help,
    &uftes_Addmember,
    &uftes_Check_status,
    &uftes_Get_statement,
    &uftes_see,
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
int uftes_see(char **args)
{
    if (see == 0)
    {
        see = 1;
    }
    else
    {
        see = 0;
    }
    return 1;
}
int uftes_Addmember(char **args)
{
    char command[] = "Addmember|";
    char *lin;
    size_t len = 0;
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
    // printf("[+]Client Socket is created.\n");

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
    // printf("[+]Connected to Server.\n");
    if (strstr(line, req))
    {
        printf("\n\t*****Adding Member***** \t\n");
        send(clientSocket, buffer, strlen(buffer), 0);
        FILE *file;
        int check = 0;
        file = fopen(line, "r");
        if (file)
        {
            while (getline(&lin, &len, file) != -1)
            {
                buffer[0] = '\0';
                printf("[+]Adding member..... \t\n");
                strcpy(buffer, command);
                strcat(buffer, district);
                strcat(buffer, user);
                strcat(buffer, ",");
                strcat(buffer, password);
                strcat(buffer, ",");
                lin[strlen(lin) - 1] = ' ';
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
                lin[0] = '\0';
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
        strcat(buffer, user);
        strcat(buffer, ",");
        strcat(buffer, password);
        strcat(buffer, ",");
        char *check;
        //////
        int counter1 = 0;
        for (int i = 0; i < strlen(line); i++)
        {
            if (line[i] == ',')
            {
                counter1++;
            }
        }
        if (counter1 == 2)
        {
            check = (char *)malloc(sizeof(line));
            strcpy(check, line);
            strtok(check, ",");
            char *sex = strtok(NULL, ",");
            if (strcmp(sex, "M") == 0 || strcmp(sex, "F") == 0)
            {
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
            else
            {
                printf("Gender must be M of F\n");
            }
        }
        else
        {
            printf("Few arguments entered\n");
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
    strcat(buffer, user);
    strcat(buffer, "|");
    send(clientSocket, buffer, strlen(buffer), 0);

    if (strcmp(buffer, ":exit") == 0)
    {
        close(clientSocket);
        printf("[-]Disconnected from server.\n");
        exit(1);
    }
    char buffer2[5000];
    if (recv(clientSocket, buffer2, sizeof(buffer2), 0) < 0)
    {
        printf("[-]Error in receiving data.\n");
    }
    else
    {
        char *p = strstr(buffer2, "NaaN");
        if (p)
        {
            strtok(buffer2, ",");
            char *num = (char *)malloc(10);
            num = strtok(NULL, ",");
            printf("\nYou have no errors but %s records of other members have errors\n", num);
        }
        else
        {
            printf("\n%s\n", buffer2);
            printf("please renter your password to fix the information.\n");
            while (getPass())
            {
                CLEAR();
                printf("Wrong password key: \n");
                while (1)
                {
                    printf("Would you like to view the keys(y/n): ");
                    // fflush(stdin);
                    // yes_no = getch();
                    scanf(" %c", &yes_no);
                    // yes_no = fgetc(stdin);
                    if (yes_no == 'n' || yes_no == 'N' || yes_no == 'y' || yes_no == 'Y')
                    {
                        break;
                    }
                    else
                    {
                        printf("Please enter y for yes and n for no\n");
                    }
                }
                if (yes_no == 'n' || yes_no == 'N')
                {
                    CLEAR();
                    continue;
                }
                else if (yes_no == 'y' || yes_no == 'Y')
                {
                    for (int i = 0; i < 26; i++)
                    {
                        printf("%s\t%s \n", key[0][i], key[1][i]);
                    }
                }
            }
            send(clientSocket, password, sizeof(password), 0);
        }
    }
    close(clientSocket);
    return 1;
}
char **
character_name_completion(const char *text, int start, int end)
{
    rl_attempted_completion_over = 1;
    return rl_completion_matches(text, character_name_generator);
}

char *
character_name_generator(const char *text, int state)
{
    static int list_index, len;
    char *name;

    if (!state)
    {
        list_index = 0;
        len = strlen(text);
    }

    while ((name = character_names[list_index++]))
    {
        if (rl_completion_quote_character)
        {
            name = strdup(name);
        }
        else
        {
            name = escape(name);
        }

        if (strncmp(name, text, len) == 0)
        {
            return name;
        }
        else
        {
            free(name);
        }
    }

    return NULL;
}

char *
escape(const char *original)
{
    size_t original_len;
    int i, j, SIZE_MAX = 200;
    char *escaped, *resized_escaped;

    original_len = strlen(original);

    if (original_len > SIZE_MAX / 2)
    {
        errx(1, "string too long to escape");
    }

    if ((escaped = malloc(2 * original_len + 1)) == NULL)
    {
        err(1, NULL);
    }

    for (i = 0, j = 0; i < original_len; ++i, ++j)
    {
        if (original[i] == ' ')
        {
            escaped[j++] = '\\';
        }
        escaped[j] = original[i];
    }
    escaped[j] = '\0';

    if ((resized_escaped = realloc(escaped, j)) == NULL)
    {
        free(escaped);
        resized_escaped = NULL;
        err(1, NULL);
    }

    return resized_escaped;
}

int quote_detector(char *line, int index)
{
    return (
        index > 0 &&
        line[index - 1] == '\\' &&
        !quote_detector(line, index - 1));
}

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
    char shell_prompt[500];
    char *line;
    char **args;
    int status = 1;
    char district2[30];
    strcpy(district2, district);
    district2[strlen(district2) - 1] = '\0';
    while (status)
    {
        if (see == 0)
        {
            snprintf(shell_prompt, sizeof(shell_prompt), "%s@%s:%s> ", user, district2, getcwd(NULL, 1024));
            line = readline(shell_prompt);
        }
        else
        {
            line = readline("UFTES> ");
        }
        args = parse(line);
        status = execute(args);
        add_history(line);
        free(line);
        free(args);
    }
}
int getPass()
{
    char *str;
    int total = 0;
    int r = 5, c = 3, i, j;
    int found = 0;
    char *message[r][c];
    for (int i = 0; i < r; i++)
    {
        for (int j = 0; j < c; j++)
        {
            printf("Cell(%d,%d): ", i, j);
            message[i][j] = (char *)malloc(2);
            scanf("%s", message[i][j]);
            total += sizeof(message[i][j]);
        }
    }
    for (int i = 0; i < r; i++)
    {
        for (int j = 0; j < c; j++)
        {
            if (strcmp(message[i][j], "1") == 0)
            {
                printf(" * ");
            }
            else
            {
                printf("   ");
            }
        }
        printf("\n");
    }
    str = (char *)malloc(total + 1);
    for (int i = 0; i < r; i++)
    {
        for (int j = 0; j < c; j++)
        {
            if (j == 0 && i == 0)
            {
                strcpy(str, message[i][j]);
            }
            else
            {
                strcat(str, message[i][j]);
            }
        }
    }
    printf("%s\n", str);
    for (int i = 0; i < r; i++)
    {
        for (int j = 0; j < c; j++)
        {
            free(message[i][j]);
        }
    }
    for (int n = 0; n < 26; n++)
    {
        if (strcmp(key[1][n], str) == 0)
        {
            strcpy(password, key[0][n]);
            found = 1;
            break;
        }
    }
    free(str);
    if (found == 0)
    {
        return 1;
    }
    else
    {
        return 0;
    }
}
void init_shell()
{
    CLEAR();
    printf("Enter district:\t");
    gets(district);
    printf("Username:\t");
    gets(user);
    printf("Enter password\n");
    while (getPass())
    {
        CLEAR();
        printf("Wrong password key: \n");
        while (1)
        {
            printf("Would you like to view the keys(y/n): ");
            // fflush(stdin);
            // yes_no = getch();
            scanf(" %c", &yes_no);
            // yes_no = fgetc(stdin);
            if (yes_no == 'n' || yes_no == 'N' || yes_no == 'y' || yes_no == 'Y')
            {
                break;
            }
            else
            {
                printf("Please enter y for yes and n for no\n");
            }
        }
        if (yes_no == 'n' || yes_no == 'N')
        {
            CLEAR();
            continue;
        }
        else if (yes_no == 'y' || yes_no == 'Y')
        {
            for (int i = 0; i < 26; i++)
            {
                printf("%s\t%s \n", key[0][i], key[1][i]);
            }
        }
    }
    printf("district %s password %s\n", district, password);
    strcat(district, "|");
    CLEAR();
    // uftes_help();
    printf("\n\n\n\n******************"
           "************************");
    printf("\n\n\n\t****WELCOME****");
    printf("\n\n\tT0 UFTES SYSTEM");
    printf("\n\n\n\n*******************"
           "***********************");
    int i;
    printf("\nUnited Front For Transformation Enrollment System uftes\n");
    printf("Type program names and arguments, and hit enter.\n");
    printf("The following are built in:\n");
    for (i = 0; i < uftes_num_builtins(); i++)
    {
        printf("  %s\n", builtin_str[i]);
    }
    printf("Use the man command for information on other programs.\n");
}
int main(int argc, char **argv)
{
    // Load config files.
    init_shell();
    fflush(stdin);
    fflush(stdout);
    rl_attempted_completion_function = character_name_completion;
    rl_completer_quote_characters = "'\"";
    rl_completer_word_break_characters = " ";
    rl_char_is_quoted_p = &quote_detector;
    // Run command loop.
    loop();

    // Perform any shutdown/cleanup.

    return EXIT_SUCCESS;
}
