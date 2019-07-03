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

    //printing signature
        for(i=0;i<5;i++){
        for(j=0;j<3;j++)
        {
           // printf("%d ", A[i][j]);    // *(j+*(A+i))
            
            if(A[i][j] == 0)
            {
                printf("%s"," ");
            }
            if(A[i][j] == 1)
            {
                printf("%s ","*");
            }
             
        }//end of inner for loop
        printf("%s","\n");
  }//end of outer loop

 
}//end of main

