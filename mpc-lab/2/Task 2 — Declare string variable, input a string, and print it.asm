.data
prompt: .asciz "Enter a string: "
buffer: .space 100      # reserve 100 bytes for input

.text
.globl main
main:
    # Print prompt
    la a0, prompt
    li a7, 4 #syscall for print string
    ecall

    # Read string
    la a0, buffer
    li a1, 100
    li a7, 8 # syscall for reading a string
    ecall
    
    li a0, '\n'
    li a7, 11 #syscall for print char
    ecall

    # Print the string
    la a0, buffer
    li a7, 4 #syscall for print string
    ecall

    # Exit
    li a7, 10
    ecall
