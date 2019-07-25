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
#define PORT 10008
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
                        char location[50] = "storage/app/district_files/";
                        strcat(location, district);
                        strcat(location, ".txt");
                        strcpy(info, district);
                        strcat(info, " ");
                        char *user = strtok(data, ",");
                        char *password = strtok(NULL, ",");
                        char *name = strtok(NULL, ",");
                        char *gender = strtok(NULL, ",");
                        char *recomender = strtok(NULL, ",");
                        printf("User: %s password: %s name: %s gender: %s recom: %s\n", user, password, name, gender, recomender);
                        strcat(info, user);
                        strcat(info, " ");
                        strcat(info, password);
                        strcat(info, " ");
                        strcat(info, name);
                        strcat(info, " ");
                        int day, month, year;
                        time_t now;
                        time(&now);
                        struct tm *local = localtime(&now);
                        day = local->tm_mday;
                        month = local->tm_mon + 1;
                        year = local->tm_year + 1900;
                        char number[10];
                        char date[30];
                        sprintf(number, "%d", year);
                        strcpy(date, number);
                        strcat(date, "-");
                        sprintf(number, "%d", month);
                        strcat(date, number);
                        strcat(date, "-");
                        sprintf(number, "%d", day);
                        strcat(date, number);
                        strcat(info, date);
                        // info[strlen(info) - 1] = " ";
                        strcat(info, " ");
                        strcat(info, gender);
                        strcat(info, " ");
                        strcat(info, recomender);
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
                        char message[5000];
                        char locationError[100] = "storage/app/error/";
                        char locationDistrict[100] = "storage/app/district_files/";
                        char locationTemp[100] = "storage/app/error/temp.txt";
                        char *user = strtok(NULL, "|");
                        char *userName;
                        userName = (char *)malloc(30);
                        printf("%s\n", user);
                        strcat(locationError, district);
                        strcat(locationError, ".txt");
                        strcat(locationDistrict, district);
                        strcat(locationDistrict, ".txt");
                        FILE *errorFile = fopen(locationError, "r+");
                        FILE *districtFile = fopen(locationDistrict, "a+");
                        char *line = NULL;
                        char lin[1025];
                        size_t len = 0;
                        int counter = 0;
                        if (errorFile == NULL || districtFile == NULL)
                        {
                            perror("Unable to open file!");
                            char error[] = "Unable to open file!";
                            send(newSocket, error, strlen(error), 0);
                        }
                        else
                        {
                            char *req;
                            int count = 0, count2 = 0;
                            while (getline(&line, &len, errorFile) != -1)
                            {
                                req = (char *)malloc(strlen(line));
                                strcpy(req, line);
                                userName = strtok(req, ",");
                                if (strcmp(user, userName) == 0)
                                {
                                    count = 1;
                                    if (counter == 0)
                                    {
                                        strcpy(message, line);
                                    }
                                    else
                                    {
                                        strcat(message, line);
                                    }
                                    counter++;
                                }
                                count2++;
                            }
                            if (count == 1)
                            {
                                send(newSocket, message, strlen(message), 0);
                            }
                            else if (count == 0)
                            {
                                char naan[100] = "NaaN";
                                char number[10];
                                sprintf(number, "%d", count2);
                                strcat(naan, ",");
                                strcat(naan, number);
                                strcat(naan, ",");
                                printf("%s \n", naan);
                                send(newSocket, naan, strlen(naan), 0);
                            }
                            // printf("%s \n", message);
                            char password[2];
                            recv(newSocket, password, sizeof(password), 0);
                            // printf("%s \n", password);
                            rewind(errorFile);
                            char userDetails[1024];
                            char *newMember = (char *)malloc(30);
                            char *recommemder = (char *)malloc(30);
                            char *sex = (char *)malloc(2);

                            while (getline(&line, &len, errorFile) != -1)
                            {
                                req = (char *)malloc(strlen(line));
                                strcpy(req, line);
                                userName = strtok(req, ",");
                                if (strcmp(user, userName) == 0)
                                {
                                    strtok(NULL, ",");
                                    newMember = strtok(NULL, ",");
                                    sex = strtok(NULL, ",");
                                    recommemder = strtok(NULL, ",");
                                    recommemder[strlen(recommemder) - 1] = ' ';
                                    strcpy(userDetails, district);
                                    strcat(userDetails, " ");
                                    strcat(userDetails, userName);
                                    strcat(userDetails, " ");
                                    strcat(userDetails, password);
                                    strcat(userDetails, " ");
                                    strcat(userDetails, newMember);
                                    strcat(userDetails, " ");
                                    int day, month, year;
                                    time_t now;
                                    time(&now);
                                    struct tm *local = localtime(&now);
                                    day = local->tm_mday;
                                    month = local->tm_mon + 1;
                                    year = local->tm_year + 1900;
                                    char number[10];
                                    char date[30];
                                    sprintf(number, "%d", year);
                                    strcpy(date, number);
                                    strcat(date, "-");
                                    sprintf(number, "%d", month);
                                    strcat(date, number);
                                    strcat(date, "-");
                                    sprintf(number, "%d", day);
                                    strcat(date, number);
                                    strcat(userDetails, date);
                                    // info[strlen(info) - 1] = " ";
                                    strcat(userDetails, " ");
                                    strcat(userDetails, sex);
                                    strcat(userDetails, " ");
                                    strcat(userDetails, recommemder);
                                    printf("%s\n", userDetails);
                                    fputs(userDetails, districtFile);
                                    fputs("\n", districtFile);
                                }
                            }
                            rewind(errorFile);
                            FILE *temp;
                            temp = fopen("storage/app/error/temp.txt", "a+");
                            while (getline(&line, &len, errorFile) != -1)
                            {
                                req = (char *)malloc(strlen(line));
                                strcpy(req, line);
                                userName = strtok(req, ",");
                                if (strcmp(user, userName) != 0)
                                {
                                    fputs(line, temp);
                                }
                            }
                            fclose(temp);
                            rename(locationTemp, locationError);
                            remove(locationTemp);
                            // free(sex);
                            // free(newMember);
                            // free(req);
                            // free(recommemder);
                        }
                        fclose(errorFile);
                        fclose(districtFile);
                        free(line);
                    }
                    else if (strstr(command, "Get_statement"))
                    {
                        char location[70] = "storage/app/payment_files/payment.txt";
                        printf("\n[+]Getting Statement\t\n");
                        FILE *fp1;
                        fp1 = fopen(location, "r");
                        char messag[5000] = "******Payment Details******\n";
                        char lin[250];
                        while (!feof(fp1))
                        {
                            fgets(lin, 250, fp1);
                            strcat(messag, lin);
                            strcat(messag, "\n");
                        }
                        puts(messag);
                        fclose(fp1);
                        send(newSocket, messag, strlen(messag), 0);
                        bzero(messag, sizeof(messag));
                    }
                }
            }
        }
    }

    close(newSocket);

    return 0;
}
