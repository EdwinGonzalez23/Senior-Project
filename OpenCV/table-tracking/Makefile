all: monitor test 

monitor: monitor.cpp
	g++ monitor.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o monitor

test: test.cpp
	g++ test.cpp `pkg-config --cflags --libs opencv4` -ljsoncpp -o test

clean:
	rm monitor test 
