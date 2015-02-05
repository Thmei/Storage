#ifndef VECTOR.H
#define VECTOR.H

#include <vector>

using namespace std;
//bunch of functio nprototypes, not much explaining needed, refer to vector.cpp
class Vector {
	public:
		int size;
		vector<double> v;
		double x,y;
		
		Vector();
		~Vector();
		Vector(const Vector&);
		Vector& operator=(const Vector& v);
		int display();
		bool isEmpty() const;
		int psh_back();
		int pop_back();
		int resize();
		int shrink_to_fit();
		int Size();
		int insert();
		int capacity();
		int erase();
		
};



#endif
