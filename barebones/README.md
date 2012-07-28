hevi/barebones
====

The **barebones** version of hevi includes.. almost nothing!  
It's just the XML Parser and the Markdown module by [Michel Fortin](http://michelf.com)!

This is the version I'd recommend for **any** kind of project, since anyone can work with it using everything s/he's confortable with. It does require more work though.

### Philosophy ###

#### Libs ####

Libs are external libraries.  
By External I mean that they usually avoid being included into the regular flow.  
They are meant to be called by AJAX or by form actions.

#### Hacks ####

Hacks are features.  
They are files that are executed before everything else and they can do anything they want.  
What to do is up to you. (I used hacks for OAuth Authentication on my website)

#### Externals ####

Externals are.. libs and stuff made by others.  
Nothing special here, move on.

#### Some other things ####

##### globals.cfg.xml Vs. global.php #####

They're not the same thing.  
**global.php** is for Framework-related vars (example: Modules).  
**global.cfg.xml** is for Website-related vars (example: Website title).