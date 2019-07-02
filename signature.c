//case 'c' : c();

#include <stdio.h>
#include <stdlib.h>

int main()
{
    int i,j;
    int A[5][3];

//Getting input 
    //onloigin
    for(i=0;i<5;i++){
        for(j=0;j<3;j++)
        {
            scanf("%d", &A[i][j]);    // *(j+*(A+i))
             
        }//end of inner for loop
        printf("%s","\n");
    }//end of outer loop

    system("clear");

//Displaying
  
  if((strncmp(word , "checkstatus" , 11)) == 0 )
  {
        for(i=0;i<5;i++){
        for(j=0;j<3;j++)
        {
           // printf("%d ", A[i][j]);    // *(j+*(A+i))
            
            if(A[i][j] == 0)
            {
                printf("%s","   ");
            }
            if(A[i][j] == 1)
            {
                printf("%s "," * ");
            }
             
        }//end of inner for loop
        printf("%s","\n");
    }
  }

 
}



/*
SECOND TESTED CODE

   int A[5][3];

    //printing
    for(;i<5;i++){
        for(;j<3;j++)
        {
            scanf("%d ", &A[i][j]);
           
        }//end of inner for loop
        puts("\n");
    }


    //printing
    for(;i<5;i++){
        for(;j<3;j++)
        {
            printf("%d ",*(j+*(A+i)));
            /*
            if(A[i][j] == 0)
            {
                printf("%s"," ");
            }
            if(A[i][j] == 1)
            {      
                printf("%s","*");
            }
             */
        //}//end of inner for loop
       // printf("%s","\n");
   // }//end of outer for loop


 //*/


/*
    CODE SIMPLIFIED REPEARIVE EDIT
        FILE *fp;
    fp = fopen("signs.txt", "w+");

    int i=0;
    for(;i<278;i++)
    {
        fprintf(fp,"case \'%c\' : %c()\n",i,i);
    }
    fclose(fp);
 */
