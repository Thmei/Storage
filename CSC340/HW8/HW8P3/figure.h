#ifndef FIGURE_H
#define FIGURE_H
 
#include <iostream>
 
using std::cout;
 
class Figure
{
    public:
        // Figure constructor
        Figure();
        // Figure destructor
        ~Figure();
 
        void draw();
        void erase();
        void center();
    private:
};
 
#endif 
