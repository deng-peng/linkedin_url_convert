# -*- coding:utf-8 -*-


def remove_query(q):
    q_arr = q.split('?')
    return q_arr[0]


def get_vanity_name_from_url(url):
    url = url.strip().lower()
    arr = url.split('/')
    arr_len = len(arr)
    if arr_len > 4:
        if arr[3] == 'in':
            return remove_query(arr[4])
        elif arr[3] == 'pub':
            if arr_len > 7:
                name = arr[4]
                first_part = remove_query(arr[7])
                if len(first_part) == 2:
                    first_part = '0' + first_part
                if len(first_part) == 1:
                    first_part = '00' + first_part
                second_part = arr[6]
                if len(second_part) == 2:
                    second_part = '0' + second_part
                third_part = arr[5]
                if third_part == '0':
                    third_part = ''
                return '{}-{}{}{}'.format(name, first_part, second_part, third_part)
    return ''
