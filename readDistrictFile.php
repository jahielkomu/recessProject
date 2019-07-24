<?
#READS district.txt and gets records into database
#it is cron jobbed
require "connection.php";
#reading directory
$path ="DistrictFiles";
$folder = opendir($path);

while(($entry = readdir($folder)) !== false){
   if($entry !== '.' && $entry !=='..'){
    $a = "DistrictFiles/$entry";
    #OPENING FILE
    $file = fopen("$entry","r+");
        //checking for empty file

        #reading from file
        while(!feof($file)){
            $content = fgets($file);
            $carray = explode(",",$content);
            list($name,$gender,$recommender,$date) = $carray;
            // echo "<pre>";
            // var_dump($carray); 
            #checking number of arguments
            if((count($carray))==4){
            #sending records to database
            $query = "INSERT INTO member(Name,Gender,Recommender,Date) VALUES('$name','$gender','recommender','$date')";
            }else{
                #writting rejected gabbage
                $f=fopen("Error.txt","a+");
                $txt = $carray;
                fwrite($f,$txt);
                fclose($f);
            }
        }
    fclose($file);

   }
  
}

