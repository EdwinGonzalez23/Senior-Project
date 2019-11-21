/*
	Read Documentation on main.cpp to understand the setups to this program better. 

	Read this example to understand what is going on: https://docs.opencv.org/3.4/d8/dc8/tutorial_histogram_comparison.html

	Any questions please slack me


*/

//These includes are coming from your opencv folder.
#include "opencv2/objdetect.hpp"
#include "opencv2/highgui.hpp"
#include "opencv2/imgproc.hpp"
#include "opencv2/videoio.hpp"
#include <iostream>

using namespace std;
using namespace cv;

/** Function Headers */
void detectAndDisplay(Mat baseImage);

/** Global variables */
CascadeClassifier face_cascade;
CascadeClassifier eyes_cascade;

/** @function main */
int main(int argc, const char** argv)
{

	/* This is finding a cascade classfier (an xml file) in the opencv folder. The path is specified in the string. Ex: data/haarcascades/har....
		Cascade Classifiers are xml sheets with many data points that are used to compare images to. In this case it loads a frontface and eye classfier.

		There is an alternative way to read the classfiers that does not use CommnandLineParser, I'll update this later in a separate branch.
	*/
	CommandLineParser parser(argc, argv,
		"{help h||}"
		"{face_cascade|data/haarcascades/haarcascade_frontalface_alt.xml|Path to face cascade.}"
		"{eyes_cascade|data/haarcascades/haarcascade_eye_tree_eyeglasses.xml|Path to eyes cascade.}"
		"{camera|0|Camera device number.}");

	parser.about("\nThis program demonstrates using the cv::CascadeClassifier class to detect objects (Face + eyes) in a video stream.\n"
		"You can use Haar or LBP features.\n\n");
	parser.printMessage();

	String face_cascade_name = samples::findFile(parser.get<String>("face_cascade"));
	String eyes_cascade_name = samples::findFile(parser.get<String>("eyes_cascade"));

	//-- 1. Load the cascades
	if (!face_cascade.load(face_cascade_name))
	{
		cout << "--(!)Error loading face cascade\n";
		return -1;
	};
	if (!eyes_cascade.load(eyes_cascade_name))
	{
		cout << "--(!)Error loading eyes cascade\n";
		return -1;
	};

	int camera_device = parser.get<int>("camera");
	VideoCapture capture;
	Mat image = imread("C:/Users/egonzalez88/Documents/ath_pics/face.jpg");

	detectAndDisplay(image); //Comment this out if using camera (read below for more info)

	/*
		The commented out code will launch your camera and read the data into the detectAndDisplay function.
		If you have a camera, uncomment the code below and comment out the aboove detectAndDisplay function.
	*/

	//-- 2. Read the video stream
	//capture.open(camera_device);
	//if (!capture.isOpened())
	//{
	//	cout << "--(!)Error opening video capture\n";
	//	return -1;
	//}

	//Mat baseImage;
	//while (capture.read(baseImage))
	//{
	//	if (baseImage.empty())
	//	{
	//		cout << "--(!) No captured baseImage -- Break!\n";
	//		break;
	//	}

	//	//-- 3. Apply the classifier to the baseImage
	//	detectAndDisplay(baseImage);

	//	if (waitKey(10) == 27)
	//	{
	//		break; // escape
	//	}
	//}
	return 0;
}

/** @function detectAndDisplay */
void detectAndDisplay(Mat baseImage)
{

	//Two test images 
	Mat image1 = imread("C:/Users/egonzalez88/Documents/ath_pics/face.jpg"); //This is the original image which will be compared to itself as well
	Mat image2 = imread("C:/Users/egonzalez88/Documents/ath_pics/face2.jpg");

	//Create Masks
	Mat baseMask, image1Mask, image2Mask;

	//Create a Mat for ROI (Region of interest: in this case the face)
	Mat baseRoi, imageOneRoi, imageTwoRoi;

	//Create a gray scale image to use in facial detection
	cvtColor(baseImage, baseMask, COLOR_BGR2GRAY);
	cvtColor(image1, image1Mask, COLOR_BGR2GRAY);
	cvtColor(image2, image2Mask, COLOR_BGR2GRAY);

	equalizeHist(baseMask, baseMask);
	equalizeHist(image1Mask, image1Mask);
	equalizeHist(image2Mask, image2Mask);


	//-- Image Rect Vectors
	std::vector<Rect> baseVector;
	//std::vector<Rect> faces_test; 
	std::vector<Rect> image2vector;
	std::vector<Rect> image1vector;
	//face_cascade.detectMultiScale(image2, faces_test);

	//Place Masks into a the above vectors (used to iterate and find wanted features)
	face_cascade.detectMultiScale(baseMask, baseVector);
	face_cascade.detectMultiScale(image1Mask, image1vector);
	face_cascade.detectMultiScale(image2Mask, image2vector);

	/* The following functions should probably be converted to separate functions */
	// Comment out ellipse if you want to draw a circle around the face
	//Find facial region of base image and crop out face
	for (size_t i = 0; i < baseVector.size(); i++)
	{
		Point center(baseVector[i].x + baseVector[i].width / 2, baseVector[i].y + baseVector[i].height / 2);
		//ellipse(baseImage, center, Size(baseVector[i].width / 2, baseVector[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4);
		baseRoi = baseImage(baseVector[i]);
	}

	//Find facial region of image1 and crop out face
	for (size_t i = 0; i < image1vector.size(); i++)
	{
		Point center(image1vector[i].x + image1vector[i].width / 2, image1vector[i].y + image1vector[i].height / 2); //Center point
		//ellipse(image1, center, Size(image1vector[i].width / 2, image1vector[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4);
		imageOneRoi = image1(image1vector[i]);
	}

	//Find facial region of image2 and crop out face
	for (size_t i = 0; i < image2vector.size(); i++)
	{
		Point center(image2vector[i].x + image2vector[i].width / 2, image2vector[i].y + image2vector[i].height / 2); //Center point
		//ellipse(image2, center, Size(faces_test[i].width / 2, faces_test[i].height / 2), 0, 0, 360, Scalar(255, 0, 255), 4); 
		imageTwoRoi = image2(image2vector[i]);
	}

	/*The following below sets up the cropped images and places them into histograms for comparisons
		Should probably be a function as well

		src_base: contains the original photo
		src_test1: first test photo
		src_test2: second test photo

	*/
	Mat src_base = baseRoi;
	Mat src_test1 = imageOneRoi;
	Mat src_test2 = imageTwoRoi;
	if (src_base.empty() || src_test1.empty() || src_test2.empty())
	{
		cout << "Could not open or find the images!\n" << endl;

	}
	//Convert Color cropped photos to Hue Saturated Photos
	Mat hsv_base, hsv_test1, hsv_test2;
	cvtColor(src_base, hsv_base, COLOR_BGR2HSV);
	cvtColor(src_test1, hsv_test1, COLOR_BGR2HSV);
	cvtColor(src_test2, hsv_test2, COLOR_BGR2HSV);

	//Create the Histograms
	Mat hsv_half_down = hsv_base(Range(hsv_base.rows / 2, hsv_base.rows), Range(0, hsv_base.cols));
	int h_bins = 50, s_bins = 60;
	int histSize[] = { h_bins, s_bins };
	// hue varies from 0 to 179, saturation from 0 to 255
	float h_ranges[] = { 0, 180 };
	float s_ranges[] = { 0, 256 };
	const float* ranges[] = { h_ranges, s_ranges };
	// Use the 0-th and 1-st channels
	int channels[] = { 0, 1 };
	Mat hist_base, hist_half_down, hist_test1, hist_test2;
	calcHist(&hsv_base, 1, channels, Mat(), hist_base, 2, histSize, ranges, true, false);
	normalize(hist_base, hist_base, 0, 1, NORM_MINMAX, -1, Mat());
	calcHist(&hsv_half_down, 1, channels, Mat(), hist_half_down, 2, histSize, ranges, true, false);
	normalize(hist_half_down, hist_half_down, 0, 1, NORM_MINMAX, -1, Mat());
	calcHist(&hsv_test1, 1, channels, Mat(), hist_test1, 2, histSize, ranges, true, false);
	normalize(hist_test1, hist_test1, 0, 1, NORM_MINMAX, -1, Mat());
	calcHist(&hsv_test2, 1, channels, Mat(), hist_test2, 2, histSize, ranges, true, false);
	normalize(hist_test2, hist_test2, 0, 1, NORM_MINMAX, -1, Mat());

	// Run 4 tests. Note, on the terminal only look at Method 0 Base-Test(1) and Base-Test(2). 
	// Values are 0 - 1, with 1 being 100 percent match. 

	for (int compare_method = 0; compare_method < 4; compare_method++)
	{
		double base_base = compareHist(hist_base, hist_base, compare_method);
		double base_half = compareHist(hist_base, hist_half_down, compare_method);
		double base_test1 = compareHist(hist_base, hist_test1, compare_method);
		double base_test2 = compareHist(hist_base, hist_test2, compare_method);
		cout << "Method " << compare_method << " Perfect, Base-Half, Base-Test(1), Base-Test(2) : " << endl;
		cout << base_base << " / " << base_half << " / " << base_test1 << " / " << base_test2 << "\n" << endl;
	}

	//Show images
	String windowName = "My HelloWorld Window"; //Name of the window
	//namedWindow(windowName); // Create a window
	Mat color;
	imshow("base", hsv_base);
	imshow("test1", hsv_test1);
	imshow("test2", hsv_test2);
	waitKey(0); // Wait for any keystroke in the window

	destroyWindow(windowName); //destroy the created window
	//imshow("Capture - Face detection", baseImage);
}