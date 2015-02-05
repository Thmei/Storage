#include <iostream>
#include <fstream> //reads files
#include <cstdlib>

using namespace std;

int main(){
	//creates object called myFile
	//allows file creating
	//o in ofstream is output
	ofstream myFile;
	//opens a file ("name of file")
	//creates a file if it is non existant
	myFile.open("File.txt");
	//any text added using << will replace current text
	//add text to file
	myFile << "Text to test output.\n ";
	//close it to prevent memory leaks
	myFile.close();
	
	
	//to store file names
	char filename[50];
	//input fstream object for input
	ifstream fileTest;
	//store filename into filename with max of 50 chars
	cin.getline(filename, 50);
	//open the user chosen file 
	fileTest.open(filename);
	//if the file is not open
	if(!fileTest.is_open()){
		//exit program if shit dont work 
		exit(EXIT_FAILURE);
	}
	
	char word[50];
	//get first value from document
	fileTest >> word;
	//while not end of file
	while(fileTest.good()){
		cout << word <<" ";
		//gets next word
		//apaprently you need this to get next word...
		fileTest >> word;
	}	
	
	
	
	return 0;
	
}
