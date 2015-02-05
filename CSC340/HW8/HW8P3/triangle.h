#ifndef TRIANGLE_H
#define TRIANGLE_H
 
#include "figure.h"
 
class Triangle:public Figure
{
    public:
        // Triangle constructor
        Triangle();
        // Triangle destructor
        ~Triangle();
 
        void draw();
        void erase();
    private:
        // Creates Triangle's data members for non-test fuctions
        int height;
        int base;
        int centerPoint;
};
 
#endif // 
