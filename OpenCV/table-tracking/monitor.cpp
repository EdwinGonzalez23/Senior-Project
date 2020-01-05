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
    return 0;
}

void display(Mat image) {
    imshow("Camera Window", image);
}




