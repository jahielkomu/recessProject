#include <stdio.h>
#include <string.h>
#include <stdlib.h>

//void checkCommand(char *text);


int main()
	{
	char word[300];//meant to store variable commands which will be tested
	char member[300], newer[300];
	int i, le, count=0, j=0; //stands for length
	FILE *fp;
	fp = fopen("file.txt","w+");

	//perfoming commands
	while(1)
	{
		//enter:
//Listing the commands at begining of the loop
	printf("%s","Commnads available\n\tAddmember\n\tcheckstatus\n\tbye\n uft : ");
	//label in while will enable another chance for correct syntax
//Entering command
	fgets(word, 300, stdin);

//getting length of the command
		le=strlen(word);//i never trusted it so idecided to count the characers manually

	//exitting
	if((strncmp(word,"c",1)) == 0 || (strncmp(word,"E",1)) == 0 ||(strncmp(word,"exit",4)) == 0 ){ break;/*breaking out of while loop */}
	
//check command
	char add[10]="addmember";

	if((strncmp(word , add , 9)) == 0) // checking for the first 9 characters of addmember if 0 skipp
	{
						/*check for text file
						if textfile:
							extract and write
						else:
							call addmember()
						*/	
	//counting arguments
	//expected number of arguments addmember name, gender, district, recommender
		for(;j<le;j++){
			if(word[j] == ',')
				{count++;/*storing number of commas*/}
		}
		puts("\n");
	//if arguments where right
			if(count < 3 || count > 3){
				printf("%s","Check number of arguments!\nuft : ");
				//goto enter;//begining of the current loop
			}
			else if(count == 3){		
					if(word[9] == ' ')//checking for space between addmember and args
					{
						strcpy(newer, word+9);//copying details
						//awrtting to file
						
						fprintf(fp,"%s\n", newer);
						
					}
			}
			else{
				printf("%s","check syntax\n");
				//goto enter;
			}

		}//getting out of second if
	}//closing out of while loop
	fclose(fp);
	puts("\n...........Exitting programm.\n");
	}//clsing out of main

//check command to evaluate commands and call functions responsible
