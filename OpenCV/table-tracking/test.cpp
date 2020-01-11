#include "opencv2/imgcodecs.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"
#include <iostream>
using namespace cv;
using namespace std;
Mat src_gray;
Mat cMask;
Mat src = imread("images/colors.png");
float one = 0;
float two = 0;
int thresh = 100;
RNG rng(12345);
void thresh_callback(int, void* );
int main( int argc, char** argv )
{
    //CommandLineParser parser( argc, argv, "{@input | HappyFish.jpg | input image}" );
    //Mat src = imread("images/colors.png");
    

        //Mat3b src = imread("images/colors.png");

    Mat3b hsv;
    cvtColor(src, hsv, COLOR_BGR2HSV);

    Mat1b mask1, mask2;
    //Mat1b cMask;
    //inRange(hsv, Scalar(0, 70, 50), Scalar(10, 255, 255), mask1);
    //inRange(hsv, Scalar(170, 70, 50), Scalar(180, 255, 255), mask2);

    inRange(hsv, Scalar(143, 0, 0), Scalar(145, 255, 255), mask1);

    Mat1b mask = mask1;// | mask2;
    //resize(mask,mask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    resize(src,src,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    cMask = mask;
    resize(cMask,cMask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);

    Vec3b colour = cMask.at<Vec3b>(162,104);
    // for (int i = 0; i < 250; i++) {
    //     for (int j = 0; j < 250; j++) {
    //         //Vec3b cs = src.at<Vec3b>(Point(i,j));
    //         //cout << cs;
    //         src.at<Vec3b>(i,j)[0] = 100;
    //         src.at<Vec3b>(i,j)[1] = 100;
    //         src.at<Vec3b>(i,j)[2] = 100;
    //     }
    // }

    cout << "Pix Colors" << endl;
    cout << colour << endl;

    thresh_callback( 0, 0 );
    waitKey();
    return 0;
}
void thresh_callback(int, void* )
{
    Mat canny_output;
    Canny( cMask, canny_output, thresh, thresh*2 );
    vector<vector<Point> > contours;
    vector<Vec4i> hierarchy;
    findContours( cMask, contours, hierarchy, RETR_TREE, CHAIN_APPROX_SIMPLE );
    Mat drawing = Mat::zeros( cMask.size(), CV_8UC3 );
    for( size_t i = 0; i< contours.size(); i++ )
    {
        //cout << contours[i] << endl;
        Scalar color = Scalar( rng.uniform(0, 256), rng.uniform(0,256), rng.uniform(0,256) );
        drawContours( drawing, contours, (int)i, Scalar(0,0,255), 2, LINE_8, hierarchy, 0 );
    }
    resize(src,src,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    imshow( "Contours", cMask);
}



// #include "opencv2/imgproc.hpp"
// #include "opencv2/highgui.hpp"
// #include "opencv2/videoio.hpp"
// #include <iostream>
// using namespace cv;
// int main()
// {
//     Mat3b src = imread("images/colors.png");

//     Mat3b hsv;
//     cvtColor(src, hsv, COLOR_BGR2HSV);

//     Mat1b mask1, mask2;
//     Mat1b cMask;
//     inRange(hsv, Scalar(0, 70, 50), Scalar(10, 255, 255), mask1);
//     inRange(hsv, Scalar(170, 70, 50), Scalar(180, 255, 255), mask2);

//     Mat1b mask = mask1 | mask2;
//     resize(mask,mask,Size(250,250), 0, 0, INTER_LINEAR_EXACT);

//     cMask = mask;

//     findContours()


//     imshow("Mask", mask);
//     waitKey();

//     return 0;
// }