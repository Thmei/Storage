#include <iostream>
#include <exception>
//#include <new>
#include "myException.h"


using namespace std;

int main(int argc, char *argv[])
{
    int *int_arr=NULL;  //declare an empty array
    long size_arr; 
    //long size_arr = 1000000000; 
    
    cout << "Type the size of the array (e.g., 100): ";
    cin >> size_arr;
    
    if ( size_arr > 9000000 )
    {
      cerr << "the value is too large ...\n";
    }
    
    /**
    //value is too large: throw an integer
    try{
        if ( size_arr > 9000000 )
          throw -100;
    }        
    catch (int& e)
    {
          cerr << "Error code=" << e << ": too large a value." <<endl; 
    }
    **/
    
    /**
    //value is too large: throw an integer
    try{
        string msg("Too large a value");
        if ( size_arr > 9000000 )
          throw msg;
    }        
    catch (string& msg)
    {
          cerr << "str-exception caught:" << msg <<endl; 
    }
    catch (...)
    {
        cerr << "Other type of exception!\n"; 
    }
    **/
    
    /**
    //value is too large: throw a user-defined exception and handle it 
    try{
        myException_Large_Value e_large_value;
        if ( size_arr > 9000000 )
          throw e_large_value;
    }        
    //catch (myException_Large_Value& e)//
    catch (exception & e)
    {
          cerr << e.what() <<endl; 
    }
    **/
    
    //call the new operator to allocate memory to int_arr
    
    /**
    //approach #1: do nothing
    int_arr = new int[size_arr];
    **/
    
    /**
    //approach #2: check the validity of int_arr
    // what is the problem?
    int_arr = new int[size_arr];
    if (int_arr == NULL){
      cerr << "Memory allocation failure: too much space was requested!\n";
      exit (-1);
    }
    **/
    
    /**
    //approach #3: catch the standard exception and handle it 
    try{
        //call the new operator to allocate memory to int_arr
        int_arr = new int[size_arr];
    }        
    catch (bad_alloc& e)
    {
          cerr << "The program has just encountered a bad_alloc exception: "
              << e.what() <<endl; 
    }
    **/
    
    //delete the array
    if (int_arr != NULL)
      delete [] int_arr;
      
      
        
    /**
    //call#1 the getAvgSalary1() function
    try{
        double avg = getAvgSalary1( 1000.00, 0);
        cout << "avg=" << avg <<endl;
    }
    catch( exception & e)
    {
        cerr << "Exception caught: " << e.what() <<endl;
    }
    **/
    
    
    /**/
    //call#2: the getAvgSalary2() function
    try{
        double avg = getAvgSalary2( 1000.00, -1);
        cout << "avg=" << avg <<endl;
    }
    catch( exception & e) 
    //or catch( myException_Negative_Number & e){} 
    //followed by catch( myException_Zero_Division & e){}
    {
        cerr << "Exception caught: " << e.what() <<endl;
    }
    /**/
    
    
    cerr << "Ready to exit the program!\n";
    return 0;
    //return EXIT_SUCCESS;
}
