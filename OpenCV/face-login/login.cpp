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
#include "PersonData.h"
#include "DataHolder.h"
//STD HEADERS
#include <fstream>
#include <iostream>
#include <vector>
#include <string>
using namespace std;
using namespace cv;
using namespace cv::face; 
using namespace Json;
//Function Headers
void calcSimilar(vector<int>& tmp);
void detectAndDisplay(Mat frame, vector<Rect> faces, Ptr<FacemarkKazemi> facemark, vector< vector<Point2f> >& shapes, DataHolder& holder, vector<int>& ids);
static bool myDetector(InputArray image, OutputArray faces, CascadeClassifier *face_cascade);
void loadDataToMem(Json::Reader& reader,Json::Value& obj,DataHolder& holder);
void compareData(DataHolder& holder, vector<int>& tmpLandmark, vector<int>& ids);
extern void printStuff();

vector<int> topIds;
int main(int argc, char const *argv[]) {  

    Json::Reader reader;
    Json::Value obj;
    DataHolder holder;
    vector<int> ids(3,-1); //ids.resize(3);
    loadDataToMem(reader, obj, holder);
    
    string filename = "resources/face_landmark_model.dat";
    if (filename.empty()){
        
        cerr << "The name  of  the model file to be loaded for detecting landmarks is not found" << endl;
        return -1;
    }
    //string image(parser.get<string>("image"));
    string image = "resources/images/me1.jpg";
    //string image2 = "test.jpeg";
    string image2 = "resources/images/me2.jpg";
    if (image.empty()){
        
        cerr << "The name  of  the image file in which landmarks have to be detected is not found" << endl;
        return -1;
    }
    //string cascade_name(parser.get<string>("face_cascade"));
    string cascade_name = "resources/haarcascade_frontalface_default.xml";
    if (cascade_name.empty()){
        cerr << "The name of the cascade classifier to be loaded to detect faces is not found" << endl;
        return -1;
    }

    /* Init only once */
    CascadeClassifier face_cascade;
    face_cascade.load("resources/haarcascade_frontalface_default.xml");
    FacemarkKazemi::Params params;
    Ptr<FacemarkKazemi> facemark = FacemarkKazemi::create(params);
    facemark->setFaceDetector((FN_FaceDetector)myDetector, &face_cascade);
    facemark->loadModel(filename);
    cout<<"Loaded model"<<endl;
    vector<Rect> faces;
    vector< vector<Point2f> > shapes;

    // Mat img = imread(image);
    // resize(img,img,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    // facemark->getFaces(img,faces);

VideoCapture capture;
    //-- 2. Read the video stream
    capture.open(0);
    if ( ! capture.isOpened() )
    {
        cout << "--(!)Error opening video capture\n";
        return -1;
    }

    Mat frame;
    Mat img;
    while ( capture.read(frame) )
    {
        if( frame.empty() )
        {
            cout << "--(!) No captured frame -- Break!\n";
            break;
        }

        //-- 3. Apply the classifier to the frame
    img = frame;
    resize(img,img,Size(250,250), 0, 0, INTER_LINEAR_EXACT);
    facemark->getFaces(img,faces);

       detectAndDisplay(img, faces, facemark, shapes, holder, ids);
       imshow("dsfsdf", frame);

        if( waitKey(10) == 27 )
        {
            break; // escape
        }
    }
    detectAndDisplay(img, faces, facemark, shapes, holder, ids);
    cout << "Workings " << endl;
    return 0;
}

void detectAndDisplay(Mat img, vector<Rect> faces,Ptr<FacemarkKazemi> facemark, vector< vector<Point2f> >& shapes, DataHolder& holder, vector<int>& ids)
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
                    //cout << res << endl;
                }
                
                    cout << endl;
            }
            //Calculate Camera Normalized Image Data Against Server Image Data
            compareData(holder, tmpLandmarks, ids);
            //namedWindow("Detected_shape");
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

//Pass A single vector of points (will make a set)
void compareData(DataHolder& holder, vector<int>& tmpLandmark, vector<int>& ids) {
    holder.compareData(tmpLandmark, ids);
    cout << "\nTop three Ids: ";
    for (int i = 0; i < ids.size(); i++) {
        cout << ids[i] << " ";
    }
    cout << endl;
}

void loadDataToMem(Json::Reader& reader,Json::Value& obj,DataHolder& holder) {
    // for (test = testList.begin(); test != testList.end(); test++) {
    //     cout << *test;
    // }
    
    ifstream ifs("data.json");
    reader.parse(ifs, obj);     // Reader can also read strings
    const Value& imageData = obj["imageData"];
    //cout << imageData << endl;
    cout << "Number of being in JSON DB " << imageData.size() << endl;
    for (int i = 0; i < imageData.size(); i++) {
        int eid = imageData[i]["employeeId"].asInt();
        string name = imageData[i]["name"].asString();
        cout << "Adding: " << eid << " " << name << endl;
        PersonData person(eid, name);
        for (int j = 0; j < imageData[i]["data"].size(); j++) {
            vector<int> tmpList;
            for (int k = 0; k < imageData[i]["data"][j].size(); k++)
            {
                int normalizedDataPoint = imageData[i]["data"][j][k].asInt();
                //cout << "fsdafsda " << normalizedDataPoint << endl;
                tmpList.push_back(normalizedDataPoint);
            }
            person.addToList(tmpList);    
        }
        
        holder.addToHolder(person);
        // cout << "size: " << imageData[i]["data"][0].size() << endl;
        // cout << imageData[i]["employeeId"];
        // cout << imageData[i]["data"][0];
    }
    cout << "Done loading to memory\n";
    cout << "-----------------------------------" << endl;

}


