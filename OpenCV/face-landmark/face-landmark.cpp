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

int main(int argc,char** argv){
    int md, td1, td2 = 0; int overall = 0;
    //Give the path to the directory containing all the files containing data
    CommandLineParser parser(argc, argv,
        "{ help h usage ?    |      | give the following arguments in following format }"
        "{ model_filename f  |      | (required) path to binary file storing the trained model which is to be loaded [example - /data/file.dat]}"
        "{ image i           |      | (required) path to image in which face landmarks have to be detected.[example - /data/image.jpg] }"
        "{ face_cascade c    |      | Path to the face cascade xml file which you want to use as a detector}"
    );
    // Read in the input arguments
    if (parser.has("help")){
        parser.printMessage();
        cerr << "TIP: Use absolute paths to avoid any problems with the software!" << endl;
        return 0;
    }
    //string filename(parser.get<string>("model_filename"));
    //string filename("model_filename");
    string filename = "face_landmark_model.dat";
    if (filename.empty()){
        parser.printMessage();
        cerr << "The name  of  the model file to be loaded for detecting landmarks is not found" << endl;
        return -1;
    }
    //string image(parser.get<string>("image"));
    string image = "me2.jpg";
    //string image2 = "test.jpeg";
    string image2 = "me3.jpg";
    if (image.empty()){
        parser.printMessage();
        cerr << "The name  of  the image file in which landmarks have to be detected is not found" << endl;
        return -1;
    }
    //string cascade_name(parser.get<string>("face_cascade"));
    string cascade_name = "haarcascade_frontalface_default.xml";
    if (cascade_name.empty()){
        parser.printMessage();
        cerr << "The name of the cascade classifier to be loaded to detect faces is not found" << endl;
        return -1;
    }

    Mat img = imread(image);
    Mat img2 = imread(image2);
    //pass the face cascade xml file which you want to pass as a detector
    CascadeClassifier face_cascade;
    face_cascade.load("haarcascade_frontalface_default.xml");
    FacemarkKazemi::Params params;
    
    Ptr<FacemarkKazemi> facemark = FacemarkKazemi::create(params);
    Ptr<FacemarkKazemi> facemarktest = FacemarkKazemi::create(params);
    facemark->setFaceDetector((FN_FaceDetector)myDetector, &face_cascade);
    facemark->loadModel(filename);
    facemarktest->setFaceDetector((FN_FaceDetector)myDetector, &face_cascade);
    facemarktest->loadModel(filename);
    cout<<"Loaded model"<<endl;
    vector<Rect> faces;
    vector<Rect> facestest;
    resize(img,img,Size(300,300), 0, 0, INTER_LINEAR_EXACT);
    resize(img2,img2,Size(300,300), 0, 0, INTER_LINEAR_EXACT);
    facemark->getFaces(img,faces);
    facemarktest->getFaces(img2,facestest);
    vector< vector<Point2f> > shapes;
    vector< vector<Point2f> > shapestest;
    //facemarktest->fit(img2,facestest,shapestest);
    // Check if faces detected or not
    // Helps in proper exception handling when writing images to the directories.
    int p[2]; int ptest[2];
    Point c2; int nump = 0;
    if(faces.size() != 0) {
        if(facemark->fit(img,faces,shapes) && facemarktest->fit(img2,facestest,shapestest))
        {
            for( size_t i = 0; i < faces.size(); i++ )
            {
                cv::rectangle(img,faces[i],Scalar( 255, 0, 0 ));
                Point center(faces[i].x + faces[i].width / 2, faces[i].y + faces[i].height / 2);
                Point c2(faces[i].x + faces[i].width / 2, faces[i].y + faces[i].height / 2);

                Point center2(facestest[i].x + facestest[i].width / 2, facestest[i].y + facestest[i].height / 2);


                p[0] = faces[i].x + faces[i].width / 2;
                p[1] = faces[i].y + faces[i].height / 2;
                ptest[0] = facestest[i].x + facestest[i].width / 2;
                ptest[1] = facestest[i].y + facestest[i].height / 2;

                cv::circle(img,center,5,cv::Scalar(0,0,255),FILLED);
                cv::circle(img2,center2,5,cv::Scalar(0,0,255),FILLED);
                
		        ellipse(img, center, Size(faces[i].width / 2, faces[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4);
                ellipse(img2, center2, Size(facestest[i].width / 2, facestest[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4);
                //cout << faces[i];
            }
            for(unsigned long i=0;i<faces.size();i++){
                
                for(unsigned long k=0;k<shapes[i].size();k++) {
                    cv::circle(img,shapes[i][k],1,cv::Scalar(0,0,255),FILLED);
                    cv::circle(img2,shapestest[i][k],1,cv::Scalar(0,0,255),FILLED);
                    cv::line(img,Point(p[0],p[1]),shapes[i][k],(255,0,0),1);
                    cv::line(img2,Point(ptest[0],ptest[1]),shapestest[i][k],(255,0,0),1);
                    Point center(faces[i].x + faces[i].width / 2, faces[i].y + faces[i].height / 2);
                    Point center2(facestest[i].x + facestest[i].width / 2, facestest[i].y + facestest[i].height / 2);
                    nump++;
                    cout << "at point: " << k << " ";// << static_cast<cv::Point2f>(shapes[i][k]);
                    Point a(p[0],p[1]);
                    Point atest(ptest[0],ptest[1]);
                    //Point b(s,6);
                    float res = norm(static_cast<cv::Point2f>(a)-static_cast<cv::Point2f>(shapes[i][k])); 
                    float res2 = norm(static_cast<cv::Point2f>(atest)-static_cast<cv::Point2f>(shapestest[i][k]));
                    if ((abs)(res2-res) <= 7.000) {
                        cout << "at: " << k << endl;
                        overall += 1;
                    }
                        
                    cout << "dist for Original: " << res << ". dist for Test Image: " << res2 << ". Difference: " << abs(res2-res) << endl;
                    cout << endl;
                    
                }
                    cout << endl;
                   
            }
            
            namedWindow("Detected_shape");
            imshow("Detected_shape", img);
            imshow("Detected_shapetest", img2);
            waitKey(0);
        }
        cout << "number of points " << nump << endl;
    cout << "overall " << overall << endl;
    } else {
        cout << "Faces not detected." << endl;
    }
    cout << "number of points " << nump << endl;
    cout << "overall " << overall << endl;
    return 0;
}

// int compareFace(Mat originalImage, String testImage) {

// }