//OPENCV header files
#include "opencv2/face.hpp"
#include "opencv2/videoio.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgcodecs.hpp"
#include "opencv2/objdetect.hpp"
#include "opencv2/imgproc.hpp"

//JSONCPP HEADERS
#include <jsoncpp/json/json.h>

//CUSTOM HEADERS

#include <iostream>
#include <string>
#include <stdio.h>
#include <sys/types.h>
#include <sys/socket.h>
#include <netinet/in.h>
#include <arpa/inet.h>
#include <stdlib.h>
#include <unistd.h>
#include <string.h>
#include <netdb.h>
#include <sys/uio.h>
#include <sys/time.h>
#include <sys/wait.h>
#include <fcntl.h>
#include <fstream>
#include <unistd.h>

using namespace std;
using namespace cv;
using namespace cv::face; 
using namespace Json;

//Function Headers
void display(Mat image);

int main () {
/*
    VideoCapture capture;
    capture.open(0);
    if ( ! capture.isOpened() )
    {
        cout << "--(!)Error opening video capture\n";
        return -1;
    }
    Mat image;
    while ( capture.read(image) )
    {
        if( image.empty() )
        {
            cout << "--(!) No captured image -- Break!\n";
            break;
        }

        resize(image,image,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
        display(image); 

        if( waitKey(10) == 27 )
        {
            break; // escape
        }
    }
*/
    Mat image;
    image = imread("images/colors2.png"); // Read the file
    resize(image,image,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    if( image.empty() )                      // Check for invalid input
    {
        cout <<  "Could not open or find the image" << std::endl ;
        return -1;
    }
    display(image);
    waitKey(0); // Wait for a keystroke in the window
    return 0;
}

void display(Mat image) {
    Mat hsv;
    cvtColor(image,hsv,COLOR_BGR2HSV);
    Mat red;
    inRange(image,Scalar(0,0,0),Scalar(0,0,255), red);
    imshow("Camera Window", red);
}




