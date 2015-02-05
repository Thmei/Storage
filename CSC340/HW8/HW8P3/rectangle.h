#ifndef RECTANGLE_H
#define RECTANGLE_H
 
#include "figure.h"
 
class Rectangle:public Figure
{
    public:
        // Rectangle constructor
        Rectangle();
        // Rectangle destructor
        ~Rectangle();
 
        void draw();
        void erase();
    private:
        // Creates Rectangle's data members for non-test fuctions
        int height;
        int width;
        int centerPoint;
};
 
#endif 
