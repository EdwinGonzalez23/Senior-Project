# How to install OpenCV on Ubuntu

1. Download the following script: install-opencv.sh --> https://github.com/milq/milq/blob/master/scripts/bash/install-opencv.sh
   Before running the script, make one change to the script. Find the line that says:
     
   `OPENCV_CONTRIB='NO'          # Install OpenCV's extra modules (YES/NO)`
    
   Change `OPENCV_CONTRIB='NO'` to `OPENCV_CONTRIB='YES'`   (CHANGE NO TO YES)
   
   Run the script. 
   
   `$ sh install-opencv.sh`
   
   A new directory called OpenCV should appear. The script will build and install the entire library. 

## Run an OpenCV program using CMAKE

1. Open the following link and follow directions 2.3 on how to build a program. http://milq.github.io/install-opencv-ubuntu-debian/

   Two file links are provided. **demo.cpp** and **CMakeLists.txt* 
   
   **Create a project directory**
   
   `$ mkdir myprojectname`
   
   Put demo.cpp and CMakeLists.txt in this directory. 
   
   **Create a build directory inside the project directory**
   
   Once inside your project directory, create a build directory 
   
   `$ mkdir build`
   
   If you type `$ ls` you should see two files and a folder. 
   
   `demo.cpp CMakeLists.txt build`
   
   Go into the build folder 
   
   `$ cd build`
   
   Now enter the following command
   
   `$ cmake ..`
   
   And this will compile your program.


## Compile using pkg-config (what we will be using) ##

First, make sure you install OpenCV.

Find your OpenCV folder (It will be where you ran the install scrtipt).
We need to navigate to the build folder. 

`$ cd OpenCV && cd build`

Now run the following (when in the build directory)

`sudo cmake CMAKE_BUILD_TYPE=Release -DWITH_QT=ON -DWITH_OPENGL=ON -DOPENCV_GENERATE_PKGCONFIG=ON -DFORCE_VTK=ON -DWITH_TBB=ON -DWITH_GDAL=ON \
       -DWITH_XINE=ON -DENABLE_PRECOMPILED_HEADERS=OFF -DCMAKE_INSTALL_PREFIX=/usr/local .. \
       -DOPENCV_EXTRA_MODULES_PATH=../opencv_contrib/modules ..` (Just copy and paste this)
       
Now enter the following two in order:

`$ sudo make`

`$ sudo make install`

Return to your open directory

`$ cd /`

To test whether this works type:

`$ pkg-config --clfags --libs opencv4`

If a list of flags appear then it worked. 

To run compile a program. 

``$ g++ demo.cpp `pkg-config --cflags --libs opencv4` ``

## How to install JsonCPP ##

1. Follow the instructions here to compile a sample program -> https://linux.tips/programming/how-to-install-and-use-json-cpp-library-on-ubuntu-linux-os

To compile with OpenCV:

``$ g++ demo.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp``

### Can ignore everything below### ####
face-landmark contains work that marks points on two faces. 
The two points are normalized and then compared against each other. 
A closeness in similarity value is computed.
	Status: In Progress. Need to add a Camera Feature. 
	

facelandmark-login contains the same logic as face-landmark. 
However, the program is being hevily modified so that it works as a login screen
authenticator for a login webpage.











	Status: In Progress. 
