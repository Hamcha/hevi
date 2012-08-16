# Changelog #

### hevi 03 ###

Macrochanges
+ Plain Cache support (can be disabled)
+ Moved some code into functions, now you can "hevi\_parse" files and strings *from* components!
+ You can now edit the $xml object before it is parsed with "Loaded hacks" *(as 03/2)*

Minichanges
+ Breaking change for RPC.js, it is now extension-independent (not restricted to only php files). You'd better add ".php" to every RPC Object you created.
+ Experimental "namespaces" support **(not used yet)**

Bugfixes
+ RPC functions are exported lowercased, so they're case-insensitive now *(as 03/2)*

### hevi 02 ###

+ RPC Support!
+ jQuery is now bundled within hevi/barebones
	+ Base theme updated

### hevi ###

+ Default codebase