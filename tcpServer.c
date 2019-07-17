#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/socket.h>
#include <sys/types.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <time.h>
#include <ctype.h>
#define PORT 9890

int main()
{

    int sockfd, ret;
    char timeNow[50];
    struct sockaddr_in serverAddr;

    int newSocket;
    struct sockaddr_in newAddr;

    socklen_t addr_size;

    char buffer[1024];
    pid_t childpid;

    sockfd = socket(AF_INET, SOCK_STREAM, 0);
    if (sockfd < 0)
    {
        printf("[-]Error in connection.\n");
        exit(1);
    }
    printf("[+]Server Socket is created.\n");

    memset(&serverAddr, '\0', sizeof(serverAddr));
    serverAddr.sin_family = AF_INET;
    serverAddr.sin_port = htons(PORT);
    serverAddr.sin_addr.s_addr = inet_addr("127.0.0.1");

    ret = bind(sockfd, (struct sockaddr *)&serverAddr, sizeof(serverAddr));
    if (ret < 0)
    {
        printf("[-]Error in binding.\n");
        exit(1);
    }
    printf("[+]Bind to port %d\n", PORT);

    if (listen(sockfd, 10) == 0)
    {
        printf("[+]Listening....\n");
    }
    else
    {
        printf("[-]Error in binding.\n");
    }

    while (1)
    {
        newSocket = accept(sockfd, (struct sockaddr *)&newAddr, &addr_size);
        if (newSocket < 0)
        {
            exit(1);
        }
        printf("[+]Connection accepted from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));

        if ((childpid = fork()) == 0)
        {
            close(sockfd);

            while (1)
            {
                recv(newSocket, buffer, 1024, 0);
                if (strcmp(buffer, ":exit") == 0)
                {
                    printf("[+]Disconnected from %s:%d\n", inet_ntoa(newAddr.sin_addr), ntohs(newAddr.sin_port));
                    break;
                }
                else
                {
                    printf("Client: %s\n", buffer);
                    char *command = strtok(buffer, "|");
                    char *district = strtok(NULL, "|");
                    printf("%s\n", command);
                    if (strstr(command, "Addmember"))
                    {
                        char *data = strtok(NULL, "|");

                        printf("\n[+]Adding Member\t\n");
                        char info[1025];
                        char location[50] = "district_files/";
                        strcat(location, district);
                        strcat(location, ".txt");
                        strcpy(info, district);
                        strcat(info, ",");
                        strcat(info, data);
                        FILE *fp;
                        for (int i = 0; i < strlen(location); i++)
                        {
                            if (location[i] >= 'A' && location[i] <= 'Z')
                            {
                                location[i] = location[i] + 32;
                            }
                        }
                        fp = fopen(location, "a+");
                        if (fp)
                        {
                            time_t now;
                            time(&now);
                            strcpy(timeNow, ctime(&now));
                            strcat(info, ",");
                            strcat(info, timeNow);
                            fprintf(fp, info);
                            fprintf(fp, "\n");
                        }
                        fclose(fp);
                        send(newSocket, info, strlen(info), 0);
                        printf("Added:\t %s\n", info);
                        bzero(info, sizeof(info));
                    }

                    else if (strstr(command, "Check_status"))
                    {
                        printf("\n[+]Checking Status\t\n");
                        printf("%s\t%s\n", command, district);
                        send(newSocket, buffer, strlen(buffer), 0);
                        printf("Added:\t %s\n", buffer);
                        bzero(buffer, sizeof(buffer));
                    }
                    else if (strstr(command, "Get_statement"))
                    {
                        char location[200] = "storage/app/payment_files/payment.txt";
                        printf("\n[+]Getting Statement\t\n");
                        FILE *fp1;
                        fp1 = fopen(location, "r");
                        char message[5000] = "******Payment Details******\n";
                        char lin[250];
                        while (!feof(fp1))
                        {
                            fgets(lin, 250, fp1);
                            strcat(message, lin);
                            strcat(message, "\n");
                        }
                        puts(message);
                        fclose(fp1);
                        send(newSocket, message, strlen(message), 0);
                        bzero(message, sizeof(message));
                    }
                }
            }
        }
    }

    close(newSocket);

    return 0;
}
