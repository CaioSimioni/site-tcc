# Principais comandos

**is_dir(string $filename): bool**
> Tells whether the given filename is a directory.


**mkdir( string $directory, int $permissions = 0777, bool $recursive = false, resource $context = ?): bool**
> Attempts to create the directory specified by directory.


**file_exists(string $filename): bool**
> Checks whether a file or directory exists.


**is_file(string $filename): bool**
> Tells whether the given file is a regular file.


**fopen( string $filename, string $mode, bool $use_include_path = false, resource $context = ?): resource**
> fopen() binds a named resource, specified by filename, to a stream.


**fclose(resource $stream): bool**
> The file pointed to by stream is closed.


**fwrite(resource $handle, string $string, int $length = ?): int**
> fwrite() writes the contents of string to the file stream pointed to by handle.


**rename(string $oldname, string $newname, resource $context = ?): bool**
> Attempts to rename oldname to newname, moving it between directories if necessary. If renaming a file and newname exists, it will be overwritten. If renaming a directory and newname exists, this function will emit a warning.


**feof(resource $stream): bool**
> Tests for end-of-file on a file pointer.


**fgets(resource $handle, int $length = ?): string|false**
> Gets a line from file pointer.


**file_get_contents( string $filename, bool $use_include_path = false, resource $context = ?, int $offset = 0, int $length = ?): string|false**
> This function is similar to file(), except that file_get_contents() returns the file in a string, starting at the specified offset up to length bytes. On failure, file_get_contents() will return false.

> file_get_contents() is the preferred way to read the contents of a file into a string. It will use memory mapping techniques if supported by your OS to enhance performance.

> Note: If you're opening a URI with special characters, such as spaces, you need to encode the URI with urlencode().


**file_put_contents( string $filename, mixed $data, int $flags = 0, resource $context = ?): int**
> This function is identical to calling fopen(), fwrite() and fclose() successively to write data to a file.

> If filename does not exist, the file is created. Otherwise, the existing file is overwritten, unless the FILE_APPEND flag is set.


**scandir(string $directory, int $sorting_order = SCANDIR_SORT_ASCENDING, resource $context = ?): array**
> Returns an array of files and directories from the directory.


**unlink(string $filename, resource $context = ?): bool**
> Deletes filename. Similar to the Unix C unlink() function. An E_WARNING level error will be generated on failure.


**rmdir(string $directory, resource $context = ?): bool**
> Attempts to remove the directory named by directory. The directory must be empty, and the relevant permissions must permit this. A E_WARNING level error will be generated on failure.


**copy(string $source, string $dest, resource $context = ?): bool**
> Makes a copy of the file source to dest.

> If you wish to move a file, use the rename() function.



## A list of possible modes for fopen() using mode
### Mode     -       Description
'r'	    Open for reading only; place the file pointer at the beginning of the file.

'r+'    Open for reading and writing; place the file pointer at the beginning of the file.

'w'	    Open for writing only; place the file pointer at the beginning of the file and truncate the file to zero length. If the file does not exist, attempt to create it.

'w+'    Open for reading and writing; otherwise it has the same behavior as 'w'.

'a'     Open for writing only; place the file pointer at the end of the file. If the file does not exist, attempt to create it. In this mode, fseek() has no effect, writes are always appended.

'a+'    Open for reading and writing; place the file pointer at the end of the file. If the file does not exist, attempt to create it. In this mode, fseek() only affects the reading position, writes are always appended.

'x'     Create and open for writing only; place the file pointer at the beginning of the file. If the file already exists, the fopen() call will fail by returning false and generating an error of level E_WARNING. If the file does not exist, attempt to create it. This is equivalent to specifying O_EXCL|O_CREAT flags for the underlying open(2) system call.

'x+'    Create and open for reading and writing; otherwise it has the same behavior as 'x'.

'c'     Open the file for writing only. If the file does not exist, it is created. If it exists, it is neither truncated (as opposed to 'w'), nor the call to this function fails (as is the case with 'x'). The file pointer is positioned on the beginning of the file. This may be useful if it's desired to get an advisory lock (see flock()) before attempting to modify the file, as using 'w' could truncate the file before the lock was obtained (if truncation is desired, ftruncate() can be used after the lock is requested).

'c+'    Open the file for reading and writing; otherwise it has the same behavior as 'c'.

'e'     Set close-on-exec flag on the opened file descriptor. Only available in PHP compiled on POSIX.1-2008 conform systems.