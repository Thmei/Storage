#include "figure.h"
 
// Figure constructor
Figure::Figure()
{
    
}
 
// Figure destructor
Figure::~Figure()
{
 
}
 
// Prints message to show that Figure's draw() has been called
void Figure::draw()
{
    cout << "Figure draw() has been called.\n";
}
 
// Prints message to show that Figure's erase() has been called
void Figure::erase()
{
    cout << "Figure erase() has been called.\n";
}
 
// Prints message to show that Figure's center() has been called
void Figure::center()
{
    cout << "Figure center() has been called.\n";
    erase();
    draw();
}
