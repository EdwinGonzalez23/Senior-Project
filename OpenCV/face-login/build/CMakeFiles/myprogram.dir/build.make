# CMAKE generated file: DO NOT EDIT!
# Generated by "Unix Makefiles" Generator, CMake Version 3.13

# Delete rule output on recipe failure.
.DELETE_ON_ERROR:


#=============================================================================
# Special targets provided by cmake.

# Disable implicit rules so canonical targets will work.
.SUFFIXES:


# Remove some rules from gmake that .SUFFIXES does not remove.
SUFFIXES =

.SUFFIXES: .hpux_make_needs_suffix_list


# Suppress display of executed commands.
$(VERBOSE).SILENT:


# A target that is always out of date.
cmake_force:

.PHONY : cmake_force

#=============================================================================
# Set environment variables for the build.

# The shell in which to execute make rules.
SHELL = /bin/sh

# The CMake executable.
CMAKE_COMMAND = /usr/bin/cmake

# The command to remove a file.
RM = /usr/bin/cmake -E remove -f

# Escaping for special characters.
EQUALS = =

# The top-level source directory on which CMake was run.
CMAKE_SOURCE_DIR = /home/edwin/Documents/c++/face-login

# The top-level build directory on which CMake was run.
CMAKE_BINARY_DIR = /home/edwin/Documents/c++/face-login/build

# Include any dependencies generated for this target.
include CMakeFiles/myprogram.dir/depend.make

# Include the progress variables for this target.
include CMakeFiles/myprogram.dir/progress.make

# Include the compile flags for this target's objects.
include CMakeFiles/myprogram.dir/flags.make

CMakeFiles/myprogram.dir/readJson.cpp.o: CMakeFiles/myprogram.dir/flags.make
CMakeFiles/myprogram.dir/readJson.cpp.o: ../readJson.cpp
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green --progress-dir=/home/edwin/Documents/c++/face-login/build/CMakeFiles --progress-num=$(CMAKE_PROGRESS_1) "Building CXX object CMakeFiles/myprogram.dir/readJson.cpp.o"
	/usr/bin/c++  $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -o CMakeFiles/myprogram.dir/readJson.cpp.o -c /home/edwin/Documents/c++/face-login/readJson.cpp

CMakeFiles/myprogram.dir/readJson.cpp.i: cmake_force
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green "Preprocessing CXX source to CMakeFiles/myprogram.dir/readJson.cpp.i"
	/usr/bin/c++ $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -E /home/edwin/Documents/c++/face-login/readJson.cpp > CMakeFiles/myprogram.dir/readJson.cpp.i

CMakeFiles/myprogram.dir/readJson.cpp.s: cmake_force
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green "Compiling CXX source to assembly CMakeFiles/myprogram.dir/readJson.cpp.s"
	/usr/bin/c++ $(CXX_DEFINES) $(CXX_INCLUDES) $(CXX_FLAGS) -S /home/edwin/Documents/c++/face-login/readJson.cpp -o CMakeFiles/myprogram.dir/readJson.cpp.s

# Object files for target myprogram
myprogram_OBJECTS = \
"CMakeFiles/myprogram.dir/readJson.cpp.o"

# External object files for target myprogram
myprogram_EXTERNAL_OBJECTS =

myprogram: CMakeFiles/myprogram.dir/readJson.cpp.o
myprogram: CMakeFiles/myprogram.dir/build.make
myprogram: CMakeFiles/myprogram.dir/link.txt
	@$(CMAKE_COMMAND) -E cmake_echo_color --switch=$(COLOR) --green --bold --progress-dir=/home/edwin/Documents/c++/face-login/build/CMakeFiles --progress-num=$(CMAKE_PROGRESS_2) "Linking CXX executable myprogram"
	$(CMAKE_COMMAND) -E cmake_link_script CMakeFiles/myprogram.dir/link.txt --verbose=$(VERBOSE)

# Rule to build all files generated by this target.
CMakeFiles/myprogram.dir/build: myprogram

.PHONY : CMakeFiles/myprogram.dir/build

CMakeFiles/myprogram.dir/clean:
	$(CMAKE_COMMAND) -P CMakeFiles/myprogram.dir/cmake_clean.cmake
.PHONY : CMakeFiles/myprogram.dir/clean

CMakeFiles/myprogram.dir/depend:
	cd /home/edwin/Documents/c++/face-login/build && $(CMAKE_COMMAND) -E cmake_depends "Unix Makefiles" /home/edwin/Documents/c++/face-login /home/edwin/Documents/c++/face-login /home/edwin/Documents/c++/face-login/build /home/edwin/Documents/c++/face-login/build /home/edwin/Documents/c++/face-login/build/CMakeFiles/myprogram.dir/DependInfo.cmake --color=$(COLOR)
.PHONY : CMakeFiles/myprogram.dir/depend
