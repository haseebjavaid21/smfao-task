# smafo-task

**How to Install and Run:**<br/>
1- **Git clone** https://github.com/haseebjavaid21/smfao-task.git : To clone the repository in your local system.<br/>
2- Go to the cloned directory in terminal and run **npm insatll** to istall the node modules and dependencies.<br/>
3- Once done run the command **php artisan serve** to start the project.<br/>
4- You can copy the URL shown in terminal and hit in the browser or just use this URL : http://127.0.0.1:8000<br/>

<br/>
**Task Details:**<br/>
The task assigned was to display bike data provided as longitude and latitude to visualize them in order have a smoother way of seeing these points. <br/>

**Solution Approach:**<br/>
1- The Backend is **Laravel** and front end is **Vue**<br/>
2- In order to get data from Laravel backend , I used **Api** methods provided by laravel.<br/>
3- In the vue front end the api was called to fetch the data and provide it for plotting on the graph.<br/>
4- The routing service api from https://www.here.com/  was used to plot the points on the map and display it.<br/>
