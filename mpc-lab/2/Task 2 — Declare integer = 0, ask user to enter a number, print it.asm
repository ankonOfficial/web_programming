.data 
msg1:   .asciz "Enter number: "
msg2:   .asciz "You entered: "
value:  .word 0

.text
.globl main
main:
    # Print prompt
    la a0, msg1
    li a7, 4
    ecall

    # Read integer
    li a7, 5
    ecall

    la t0, value       # load address of value
    sw a0, 0(t0)       # store user input

    # Print "You entered: "
    la a0, msg2
    li a7, 4
    ecall

    # Load and print value
    la t0, value
    lw a0, 0(t0)
    li a7, 1
    ecall

    # Exit
    li a7, 10
    ecall