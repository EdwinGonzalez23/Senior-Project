all: login

login: login.cpp
	g++ login.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o login

clean:
	rm login