#include "opencv2/imgcodecs.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"

#include <iostream>
#include <stdlib.h>

//Custom Classes
#include "HsvColor.h"

using namespace cv;
using namespace std;

// Global Variables
Mat src;// = imread("images/green.png");
Mat mask;
Mat hsv;
HsvColor green("green"), yellow("yellow"), red1("red"), red2("red"), blue("blue");
RNG rng(12345);
// Function Headers
void findColor(Mat image);
void outline(Mat tmp);

void display(Mat frame) {
    imshow("123", frame);
}

int main () {
    //inRange(hsv, Scalar(0, 70, 50), Scalar(10, 255, 255), mask1);
    //inRange(hsv, Scalar(170, 70, 50), Scalar(0,70,50), mask2);
    /* Define Color Spaces for Greed, Yellow, Red, Blue
       See: https://stackoverflow.com/questions/47483951/how-to-define-a-threshold-value-to-detect-only-green-colour-objects-in-an-image

       For HSV Map
    */

    // Green
    green.setLow(40,70,50);
    green.setHigh(70,255,255);

    // Yellow
    yellow.setLow(20,0,0);
    yellow.setHigh(35,255,255);

    // Red
    red1.setLow(0,70,50);
    red1.setHigh(10,255,255);

    red2.setLow(170,70,50);
    red2.setHigh(180,255,255);    

    // Blue 
    // blue.setLow(110,100,50);
    // blue.setHigh(125,255,255);
    blue.setLow(110,100,0);
    blue.setHigh(130,255,255);

    
    VideoCapture capture;
    capture.open(0);
    if ( ! capture.isOpened() )
    {
        cout << "--(!)Error opening video capture\n";
        return -1;
    }
    Mat image;
    while ( capture.read(src) )
    {
        if( src.empty() )
        {
            cout << "--(!) No captured image -- Break!\n";
            break;
        }

        //resize(image,image,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
        //display(image); 
        cvtColor(src, hsv, COLOR_BGR2HSV);
        //Find Yellow
        //inRange(hsv, Scalar(20, 0, 0), Scalar(35, 255, 255), mask);
        
        resize(src,src,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
        //resize(mask,mask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
        findColor(src);
        //display(src);
        if( waitKey(10) == 27 )
        {
            break; // escape
        }
    }

    //findColor(src);

   // imshow( "Contours", mask);
    //waitKey();
    waitKey();
    return 0;
}

void findColor(Mat image) {

    //Check Green
    Mat g,y,r,b;
    Mat r1,r2;
    //inRange(hsv, Scalar(145,0,0), Scalar(155,255,255),mask);

    inRange(hsv, Scalar(green.getLow(0),green.getLow(1),green.getLow(2)),Scalar(green.getHigh(0),green.getHigh(1),green.getHigh(2)),g);
    inRange(hsv, Scalar(yellow.getLow(0),yellow.getLow(1),yellow.getLow(2)),Scalar(yellow.getHigh(0),yellow.getHigh(1),yellow.getHigh(2)),y);
    inRange(hsv, Scalar(red1.getLow(0),red1.getLow(1),red1.getLow(2)),Scalar(red1.getHigh(0),red1.getHigh(1),red1.getHigh(2)),r1);
    inRange(hsv, Scalar(red2.getLow(0),red2.getLow(1),red2.getLow(2)),Scalar(red2.getHigh(0),red2.getHigh(1),red2.getHigh(2)),r2);
    inRange(hsv, Scalar(blue.getLow(0),blue.getLow(1),blue.getLow(2)),Scalar(blue.getHigh(0),blue.getHigh(1),blue.getHigh(2)),b);

    r = r1 | r2;

    resize(g,g,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    resize(b,b,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    resize(y,y,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    resize(r,r,Size(250,250), 0, 0, INTER_LINEAR_EXACT);

    imshow("OG",src); 
    // imshow( "Blue", b);
    // imshow( "Red", r);
    // imshow( "Yellow", y);
    imshow( "Green", g);
   // waitKey();
    //string colorResult = 
    //outline(g);
    // if (colorResult == "none")
    //     colorResult = outline(y);
    // if (colorResult == "none")
    //     colorResult = outline(b);
    // if (colorResult == "none")
    //     colorResult = "none";

    //cout << colorResult << endl;

    outline(g);
    outline(y);
    outline(r);
    outline(b);
}

void outline(Mat tmp) {
    //imshow("zzz", tmp);
    //return "red";
    vector<vector<Point> > contours;
    vector<Vec4i> hierarchy;
    findContours(tmp, contours, hierarchy, RETR_TREE, CHAIN_APPROX_SIMPLE );
    Mat drawing = Mat::zeros( tmp.size(), CV_8UC3 );
    
    if (!contours.empty()) {
        //cout << "Found a color " << endl;
        Point top = contours[0][0];
        int x = top.x;
        int y = top.y;

        Mat rgbPixel = src(Rect(x,y,1,1));
        Mat tmpHsv;
        cvtColor(rgbPixel, tmpHsv, COLOR_BGR2HSV);
        Vec3b hsv = tmpHsv.at<Vec3b>(0,0);
        int hsvPixel = hsv.val[0];
        cout << "hsvPixel " << hsv << endl;

        // cout << "c " << c << endl;
        if (hsvPixel >= green.getLow(0) && hsvPixel <= green.getHigh(0)) {
            cout << green.getColor() << endl;
            
        }
        else if (hsvPixel >= red1.getLow(0) && hsvPixel <= red1.getHigh(0))
            cout << red1.getColor() << endl;
        else if (hsvPixel >= red2.getLow(0) && hsvPixel <= red2.getHigh(0))
            cout << red2.getColor() << endl;
        else if (hsvPixel >= blue.getLow(0) && hsvPixel <= blue.getHigh(0))
            cout << blue.getColor() << endl;
        // else if (hsvPixel >= yellow.getLow(0) && hsvPixel <= yellow.getHigh(0))
        //     cout << yellow.getColor() << endl;
        //else cout <<  "none" << endl;


        // cout << "c " << c << endl;
        // if (hsvPixel >= green.getLow(0) && hsvPixel <= green.getHigh(0))
        //     return green.getColor();
        // else if (hsvPixel >= yellow.getLow(0) && hsvPixel <= yellow.getHigh(0))
        //     return yellow.getColor();
        // else if (hsvPixel >= red1.getLow(0) && hsvPixel <= red1.getHigh(0))
        //     return red1.getColor();
        // else if (hsvPixel >= red2.getLow(0) && hsvPixel <= red2.getHigh(0))
        //     return red2.getColor();
        // else if (hsvPixel >= blue.getLow(0) && hsvPixel <= blue.getHigh(0))
        //     return blue.getColor();
        // else return "none";
    }
}