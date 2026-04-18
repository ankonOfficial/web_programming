.data
msgA:   .asciz "Enter first number: "
msgB:   .asciz "Enter second number: "
msgC:   .asciz "You entered: "
space:  .asciz " "
newline:.asciz "\n"

n1:     .word 0
n2:     .word 0

.text
.globl main

main:
    la a0, msgA
    li a7, 4
    ecall

    li a7, 5
    ecall
    la t0, n1
    sw a0, 0(t0)

    la a0, msgB
    li a7, 4
    ecall

    li a7, 5
    ecall
    la t0, n2
    sw a0, 0(t0)

    la a0, msgC
    li a7, 4
    ecall

    la t0, n1
    lw a0, 0(t0)
    li a7, 1
    ecall

    la a0, space
    li a7, 4
    ecall

    la t0, n2
    lw a0, 0(t0)
    li a7, 1
    ecall

    la a0, newline
    li a7, 4
    ecall

    li a7, 10
    ecall
