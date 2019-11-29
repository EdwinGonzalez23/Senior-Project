#include "opencv2/face.hpp"
#include "opencv2/videoio.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgcodecs.hpp"
#include "opencv2/objdetect.hpp"
#include "opencv2/imgproc.hpp"
#include <iostream>
#include <vector>
#include <string>
using namespace std;
using namespace cv;
using namespace cv::face;

//Function Headers
void calcSimilar(vector<int>& tmp);
void detectAndDisplay(Mat frame, vector<Rect> faces, Ptr<FacemarkKazemi> facemark, vector< vector<Point2f> >& shapes);
static bool myDetector(InputArray image, OutputArray faces, CascadeClassifier *face_cascade);

vector<int> topIds;
int main(int argc, char const *argv[]) {
    
    string filename = "face_landmark_model.dat";
    if (filename.empty()){
        
        cerr << "The name  of  the model file to be loaded for detecting landmarks is not found" << endl;
        return -1;
    }
    //string image(parser.get<string>("image"));
    string image = "images/me1.jpg";
    //string image2 = "test.jpeg";
    string image2 = "images/me2.jpg";
    if (image.empty()){
        
        cerr << "The name  of  the image file in which landmarks have to be detected is not found" << endl;
        return -1;
    }
    //string cascade_name(parser.get<string>("face_cascade"));
    string cascade_name = "haarcascade_frontalface_default.xml";
    if (cascade_name.empty()){
        cerr << "The name of the cascade classifier to be loaded to detect faces is not found" << endl;
        return -1;
    }

    /* Init only once */
    CascadeClassifier face_cascade;
    face_cascade.load("haarcascade_frontalface_default.xml");
    FacemarkKazemi::Params params;
    Ptr<FacemarkKazemi> facemark = FacemarkKazemi::create(params);
    facemark->setFaceDetector((FN_FaceDetector)myDetector, &face_cascade);
    facemark->loadModel(filename);
    cout<<"Loaded model"<<endl;
    vector<Rect> faces;
    vector< vector<Point2f> > shapes;

    Mat img = imread(image);
    resize(img,img,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    facemark->getFaces(img,faces);


    detectAndDisplay(img, faces, facemark, shapes);
    cout << "Workings " << endl;
    return 0;
}

void detectAndDisplay(Mat img, vector<Rect> faces,Ptr<FacemarkKazemi> facemark, vector< vector<Point2f> >& shapes)
{
    vector<int> tmpLandmarks;
    // Check if faces detected or not
    // Helps in proper exception handling when writing images to the directories.
    int p[2]; int ptest[2];
    Point c2; int nump = 0;
    if(faces.size() != 0) {
        if(facemark->fit(img,faces,shapes))
        {
            cout << "Faces Found " << endl;
            for( size_t i = 0; i < faces.size(); i++ )
            {
                cv::rectangle(img,faces[i],Scalar( 255, 0, 0 ));
                Point center(faces[i].x + faces[i].width / 2, faces[i].y + faces[i].height / 2);
                p[0] = faces[i].x + faces[i].width / 2;
                p[1] = faces[i].y + faces[i].height / 2;
                cv::circle(img,center,5,cv::Scalar(0,0,255),FILLED);
		        ellipse(img, center, Size(faces[i].width / 2, faces[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4);
            }
            for(unsigned long i=0;i<faces.size();i++){
                
                for(unsigned long k=0;k<shapes[i].size();k++) {
                    cv::circle(img,shapes[i][k],1,cv::Scalar(0,0,255),FILLED);
                    cv::line(img,Point(p[0],p[1]),shapes[i][k],(255,0,0),1);
                    Point center(faces[i].x + faces[i].width / 2, faces[i].y + faces[i].height / 2);
                    nump++;
                    //cout << "at point: " << k << " ";// << static_cast<cv::Point2f>(shapes[i][k]);
                    Point a(p[0],p[1]);
                    //Point atest(ptest[0],ptest[1]);
                    //Point b(s,6);
                    float res = norm(static_cast<cv::Point2f>(a)-static_cast<cv::Point2f>(shapes[i][k])); 
                    tmpLandmarks.push_back(res);
                    // if ((abs)(res2-res) <= 10.000) {
                    //     cout << "at: " << k << endl;
                    //     overall += 1;
                    // }
                    cout << res << endl;
                }
                
                    cout << endl;
            }
            //Calculate Camera Normalized Image Data Against Server Image Data
            calcSimilar(tmpLandmarks);
            namedWindow("Detected_shape");
            imshow("Detected_shape", img);
            waitKey(0);
        }
    } else {
        cout << "Faces not detected." << endl;
    }
}

static bool myDetector(InputArray image, OutputArray faces, CascadeClassifier *face_cascade)
{
    Mat gray;

    if (image.channels() > 1)
        cvtColor(image, gray, COLOR_BGR2GRAY);
    else
        gray = image.getMat().clone();

    equalizeHist(gray, gray);

    std::vector<Rect> faces_;
    face_cascade->detectMultiScale(gray, faces_, 1.4, 2, CASCADE_SCALE_IMAGE, Size(30, 30));
    Mat(faces_).copyTo(faces);
    return true;
}
/*
    Read File (JSON preffered) and compare normalized Data
    Returns a Vector with the top three employee IDs that closely resemble
    the base image
*/
void calcSimilar(vector<int>& tmp) {
    cout << "Cal here " << endl;
}


