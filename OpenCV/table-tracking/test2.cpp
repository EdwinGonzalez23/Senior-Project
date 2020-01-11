#include "opencv2/imgcodecs.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"
#include <iostream>

//Custom Classes
#include "HsvColor.h"

using namespace cv;
using namespace std;

// Global Variables
Mat src = imread("images/colors.png");
Mat mask;
Mat hsv;
HsvColor green("green"), yellow("yellow"), red1("red"), red2("red"), blue("blue");
RNG rng(12345);
// Function Headers
void findColor(Mat image);
void outline(Mat tmp);

int main () {
    //inRange(hsv, Scalar(0, 70, 50), Scalar(10, 255, 255), mask1);
    //inRange(hsv, Scalar(170, 70, 50), Scalar(0,70,50), mask2);
    /* Define Color Spaces for Greed, Yellow, Red, Blue
       See: https://stackoverflow.com/questions/47483951/how-to-define-a-threshold-value-to-detect-only-green-colour-objects-in-an-image

       For HSV Map
    */

    // Green
    green.setLow(36,0,0);
    green.setHigh(86,255,255);

    // Yellow
    yellow.setLow(20,0,0);
    yellow.setHigh(35,255,255);

    // Red
    red1.setLow(0,70,50);
    red1.setHigh(10,255,255);

    red2.setLow(170,70,50);
    red2.setHigh(180,255,255);    

    // Blue 
    blue.setLow(100,0,0);
    blue.setHigh(125,255,255);

    cvtColor(src, hsv, COLOR_BGR2HSV);
    //Find Yellow
    //inRange(hsv, Scalar(20, 0, 0), Scalar(35, 255, 255), mask);
    
    resize(src,src,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    //resize(mask,mask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);

    findColor(src);

   // imshow( "Contours", mask);
    //waitKey();
    waitKey();
    return 0;
}

void findColor(Mat image) {

    //Check Green
    Mat g,y,r,b;

    inRange(hsv, Scalar(green.getLow(0),green.getLow(1),green.getLow(2)),Scalar(green.getHigh(0),green.getHigh(1),green.getHigh(2)),mask);

    resize(mask,mask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    //imshow( "Contours", mask);
    outline(mask);
}

void outline(Mat tmp) {
    vector<vector<Point> > contours;
    vector<Vec4i> hierarchy;
    findContours(tmp, contours, hierarchy, RETR_TREE, CHAIN_APPROX_SIMPLE );
    Mat drawing = Mat::zeros( tmp.size(), CV_8UC3 );
    for( size_t i = 0; i< contours.size(); i++ )
    {
        //cout << contours[i] << endl;
        Scalar color = Scalar( rng.uniform(0, 256), rng.uniform(0,256), rng.uniform(0,256) );
        drawContours( drawing, contours, (int)i, color, 2, LINE_8, hierarchy, 0 );
    }
    resize(drawing, drawing,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    Point top = contours[0][0];
    int x,y;
    x = top.x;
    y = top.y + 20;
    cout << y << endl;
    Vec3b colour = src.at<Vec3b>(y,x);
    cout << "Color " << colour << endl;
    imshow( "Contours", src);
}