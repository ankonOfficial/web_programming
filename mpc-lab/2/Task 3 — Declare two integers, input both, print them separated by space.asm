.data
msgA:   .asciz "Enter first number: "
msgB:   .asciz "Enter second number: "
msgC:   .asciz "You entered: "
space:  .asciz " "
n1:     .word 0
n2:     .word 0

.text
.globl main
main:
    # Prompt for first number
    la a0, msgA
    li a7, 4
    ecall

    # Read first number
    li a7, 5
    ecall
    la t0, n1
    sw a0, 0(t0)

    # Prompt for second number
    la a0, msgB
    li a7, 4
    ecall

    # Read second number
    li a7, 5
    ecall
    la t0, n2
    sw a0, 0(t0)

    # Print "You entered: "
    la a0, msgC
    li a7, 4
    ecall

    # Print first integer
    la t0, n1
    lw a0, 0(t0)
    li a7, 1
    ecall

    # Print space
    la a0, space
    li a7, 4
    ecall

    # Print second integer
    la t0, n2
    lw a0, 0(t0)
    li a7, 1
    ecall

    # Exit
    li a7, 10
    ecall