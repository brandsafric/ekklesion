Ekklesion Development Documentation
===================================

Thanks for taking the time to read Ekklesion's dev docs. In short, they are an attempt
to explain how Ekklesion works so you can craft awesome contributions to the project.

Ekklesion is modular. That means that every big piece of the application consists of
a separate mini-application in itself, and can operate by itself or depend of other
modules. These modules only know the modules they depend on to work: nothing else.

To create a module, you need to create a class name implementing the module interface.

The main module of Ekklesion is People.