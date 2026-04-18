.data
msg1:   .asciz "Enter a character: "
msg2:   .asciz "You entered: "
newline: .string "\n"

.text
.globl main
main:
    # Print "Enter a character: "
    la a0, msg1
    li a7, 4 # syscall for print_string
    ecall

    # Read a character
    li a7, 12         # syscall for read char 12 | syscall for print char 11
    ecall
    mv t0, a0         # store char in t0

    # Print "You entered: "
    la a0, msg2
    li a7, 4 # syscall for print string
    ecall

    # Print the character
    mv a0, t0
    li a7, 11
    ecall

    # Print newline
    li a0, '\n'
    li a7, 11
    ecall

    # Exit
    li a7, 10
    ecall
