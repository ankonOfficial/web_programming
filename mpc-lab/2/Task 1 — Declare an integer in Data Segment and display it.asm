.data
num:    .word 42      # declared integer 000000000.... 

.text
.globl main
main:
    # Load the integer
    la a0, num
    lw a0, 0(a0)

    # Print integer
    li a7, 1
    ecall

    # Exit
    li a7, 10
    ecall
