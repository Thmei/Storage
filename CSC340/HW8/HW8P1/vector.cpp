#include <iostream>
#include <vector>
#include "vector.h"

using namespace std;

Vector::Vector(){
	//Vector Constructor
}
Vector::Vector(const Vector&){
	//Vector Copy Constructor
	//one of the big three
}

Vector::~Vector(){
	//Vector Destructor
	//one of the big three
}


Vector& Vector::operator=(const Vector& v)
  {
    if(this != &v)
    {
      x = v.x;
      y = v.y;
    }
    return *this;
    //Assignment operator, one of the big three
  }
  
  

int Vector::display(){
	int i;
	cout << "Your Vector: ";
	for(int i =0; i<v.size();i++)
	cout << v[i] << " ";
	//function to display vector
}

bool Vector::isEmpty() const{
	
	return size == 0;
	//Checking if it is empty
}

int Vector::psh_back(){
	double value;
	cout << "Enter a value to push back:";
	cin >> value;
	v.push_back(value);
	//Push_Back function	
	
}

int Vector::pop_back(){
	v.pop_back();
	//Pop_back function
}

int Vector::resize(){
	int value;
	cout << "Enter a value to resize the vector to:";
	cin >> value;
	v.resize(value);
	cout << "\nThe new size of the vector is " << value << endl;
	//function to resize vector
}

int Vector::shrink_to_fit(){
//	v.shrink_to_fit(); 
//it states that shrink to fit does not exist for this member function, perhaps I am not using c++ 11???? Remove the "//" to test if you wish
	cout << "Vector shrink_to_fit function has been called\n";
	cout << "Capacity of vector is " << v.capacity() << endl;
	//function to shrink and get rid of excess space
}

int Vector::Size(){
	cout << "The size of the vector is " << v.size() << endl;
	//function to return size
}

int Vector::insert(){
	double value;
	cout << "Enter a value you wish to insert: ";
	cin >> value;
	int n;
	cout << "\nWhere would you like to insert that value? Enter a number(INT) for location: ";
	cin >> n;
	v.insert( v.begin()+n,value);
	//function to insert value into specified location in vector
	
}

int Vector::capacity(){
	cout << "The capacity of the vector is " << v.capacity() << endl;
	//function to return capacity
}

int Vector::erase(){
	int n;
	cout << "At what location would you like to erase a value? \nEnter a number(INT) for location, e.g (0 = first element): "; 
	cin >> n;
	v.erase(v.begin()+n);
	cout << "Value was erased \n";
	//function to erase value at specified location in the vacotor
}





