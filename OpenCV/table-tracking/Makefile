all: monitor test test2 server 

monitor: monitor.cpp
	g++ monitor.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o monitor

test: test.cpp
	g++ test.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o test

test2: test2.cpp
	g++ test2.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o test2

server: server.cpp
	g++ server.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o server

clean:
	rm monitor test test2 server
