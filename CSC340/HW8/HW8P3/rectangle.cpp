#include "rectangle.h"
 
// Rectangle constructor
Rectangle::Rectangle()
{

}
 
// Rectangle destructor
Rectangle::~Rectangle()
{
 
}
 
// Prints message to show that Rectangle's draw() has been called
void Rectangle::draw()
{
    cout << "Rectangle draw() has been called.\n";
}
 
// Prints message to show that Rectangle's erase() has been called
void Rectangle::erase()
{
    cout << "Rectangle erase() has been called.\n";
}
