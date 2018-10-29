#!/usr/bin/env python3
#-*- coding: utf-8 -*-

import sys

nodes = ('A', 'B', 'C', 'D', 'E', 'F')

distances = {
    'A': {'B': 3, 'D': 3, 'F': 6},
    'B': {'A': 3, 'D': 1, 'E': 3},
    'C': {'E': 2, 'F': 3},
    'D': {'A': 3, 'B': 1, 'E': 1, 'F': 2},
    'E': {'B': 3, 'C': 2, 'D': 1, 'F': 5},
    'F': {'A': 6, 'C': 3, 'D': 2, 'E': 5},
}

start_node = input()
end_node = input()
nodes_last = {}
nodes_tmp = {elem: None for elem in nodes}
nodes_parents = {}
nodes_path = []
nodes_tmp[start_node] = 0
cur_node = start_node
cur_cost = 0

if not len(distances[start_node]):
    print("Из заданной точки нет маршрутов")
    sys.exit()


while True:
    if len(distances[cur_node].items()) > 0:
        for node, cost in distances[cur_node].items():
            if node in nodes_tmp:
                new_cost = cur_cost + cost
                if nodes_tmp[node] is None or nodes_tmp[node] > new_cost:
                    nodes_tmp[node] = new_cost
                    nodes_parents[node] = cur_node
    nodes_last[cur_node] = cur_cost
    del nodes_tmp[cur_node]
    if len(nodes_tmp) == 0: 
        break
    selection_next = [elem for elem in nodes_tmp.items() if elem[1]]
    cur_node, cur_cost = sorted(selection_next, key = lambda x: x[1])[0]

if end_node not in nodes_parents:
    print("Нет маршрута")
else:
    node_point = end_node
    while node_point:
        nodes_path.append(node_point)
        node_point = nodes_parents.get(node_point)
        print(nodes_path);
        print(node_point);
    print(list(reversed(nodes_path)))
    print(nodes_last[end_node])

