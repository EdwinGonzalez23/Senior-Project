all: login OpenCVServer

login: login.cpp
	g++ login.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o login

OpenCVServer: OpenCVServer.cpp
	g++ OpenCVServer.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o OpenCVServer

clean:
	rm login OpenCVServer