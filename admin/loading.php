<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" 
        content="width=device-width,
                 initial-scale=1.0">
  <title>Dots loading animation</title>
</head>
<style>
 .loader{
   position: absolute;
   top: 50%;
   left: 50%;
   transform: translate(-50%, -50%);
   display: flex;
   align-items: center;
 }
 /* Creating the dots */
 span{
   height: 25px;
   width: 25px;
   margin-right: 10px;
   border-radius: 50%;
   background-color: green;
   animation: loading 1s linear infinite;
 }
 /* Creating the loading animation*/
 @keyframes loading {
   0%{
    transform: translateX(0);
   }
   25%{
    transform: translateX(15px);
   }
   50%{
    transform: translateX(-15px);
   }
   100%{
    transform: translateX(0);
   }
     
 }
span:nth-child(1){
  animation-delay: 0.1s;
}
span:nth-child(2){
  animation-delay: 0.2s;
}
span:nth-child(3){
  animation-delay: 0.3s;
}
span:nth-child(4){
  animation-delay: 0.4s;
}
span:nth-child(5){
  animation-delay: 0.5s;
}
</style> 
<body>
    <h1> asdsd </h1>
  <div class="loader">
    <span></span>
    <span ></span>
    <span ></span>
    <span ></span>
  </div>
</body>
</html>