.model small
.stack 64h
.data

.code
MAIN proc
	mov ah, 06
	mov al, 00
	mov bh, 07
	mov ch, 00
	mov cl, 00
	mov dh, 24
	mov dl, 79
	int 10h
	
	mov ah, 4ch
	int 21h
MAIN endp
begin endp