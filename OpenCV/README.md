UPDATE:
LINKING between OPENCV and JSONCPP has been completed.

To Compile:

g++ [proram name] `pkg-config --cflags --libs opencv4` -ljsoncpp -o [executable name]

Things to Note. OpenCV 4 no longer supports pkg-config by defalt. 
SEE THIS PAGE: https://github.com/opencv/opencv/issues/13154

HOW TO SET UP OPENCV

1st) Run the install Script -> https://github.com/milq/milq/blob/master/scripts/bash/install-opencv.sh

2nd) Once the script finishes, an OpenCV directory should exist. Navigate into it and into the build folder.
	cd OpenCV && cd build 

3rd) The project is already made but must be remade with new flags to ensure pkg-config opencv4 exists
	When inside the build folder enter
	$ sudo cmake CMAKE_BUILD_TYPE=Release -DWITH_QT=ON -DWITH_OPENGL=ON -DOPENCV_GENERATE_PKGCONFIG=ON -DFORCE_VTK=ON -DWITH_TBB=ON -DWITH_GDAL=ON \
       -DWITH_XINE=ON -DENABLE_PRECOMPILED_HEADERS=OFF -DCMAKE_INSTALL_PREFIX=/usr/local .. \
       -DOPENCV_EXTRA_MODULES_PATH=../opencv_contrib/modules ..
       
       You can just copy and Paste. 
       
       Then $sudo make
       Then $sudo make install 
     
4)Install JSONCPP -> https://linux.tips/programming/how-to-install-and-use-json-cpp-library-on-ubuntu-linux-os

Can now use g++ to compile.

A folder for back end work. 
 
Folder description 

cpp: files containing c++ programs. 


face-landmark contains work that marks points on two faces. 
The two points are normalized and then compared against each other. 
A closeness in similarity value is computed.
	Status: In Progress. Need to add a Camera Feature. 
	

facelandmark-login contains the same logic as face-landmark. 
However, the program is being hevily modified so that it works as a login screen
authenticator for a login webpage.











	Status: In Progress. 
