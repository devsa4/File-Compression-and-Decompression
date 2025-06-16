#include <iostream>
#include <fstream>
#include <queue>
#include <unordered_map>
#include <vector>
#include <bitset>
using namespace std;

struct N {
    char c;
    int f;
    N *l, *r;
    N(char ch, int fr) : c(ch), f(fr), l(nullptr), r(nullptr) {}
};

struct Cmp {
    bool operator()(N* a, N* b) {
        return a->f > b->f;
    }
};

unordered_map<char, string> m;

void gen(N* n, const string& s) {
    if (!n) return;
    if (!n->l && !n->r) m[n->c] = s;
    gen(n->l, s + "0");
    gen(n->r, s + "1");
}

N* build(unordered_map<char, int>& freq) {
    priority_queue<N*, vector<N*>, Cmp> q;
    for (auto& p : freq) q.push(new N(p.first, p.second));
    while (q.size() > 1) {
        N* a = q.top(); q.pop();
        N* b = q.top(); q.pop();
        N* x = new N('\0', a->f + b->f);
        x->l = a;
        x->r = b;
        q.push(x);
    }
    return q.top();
}

void wr(const string& b, const string& o, int pad) {
    ofstream out(o, ios::binary);
    out.put(pad);
    int c = 0;
    char byte = 0;
    for (char x : b) {
        byte <<= 1;
        if (x == '1') byte |= 1;
        if (++c == 8) {
            out.put(byte);
            byte = 0;
            c = 0;
        }
    }
    if (c) {
        byte <<= (8 - c);
        out.put(byte);
    }
    out.close();
}

int main(int a, char* v[]) {
    if (a != 3) {
        cerr << "Usage: ./compress in.txt out.bin\n";
        return 1;
    }

    unordered_map<char, int> f;
    ifstream in(v[1], ios::in);
    if (!in) {
        cerr << "Can't open file\n";
        return 1;
    }

    string t;
    char ch;
    while (in.get(ch)) {
        t += ch;
        f[ch]++;
    }
    in.close();

    N* r = build(f);
    gen(r, "");

    string b;
    for (char c : t) b += m[c];
    int pad = (8 - b.size() % 8) % 8;
    b += string(pad, '0');

    wr(b, v[2], pad);

    ofstream cfile("code.txt", ios::out);
    for (auto& [c, s] : m) {
        if (c == '\n') cfile << "newline " << s << '\n';
        else if (c == ' ') cfile << "space " << s << '\n';
        else cfile << c << ' ' << s << '\n';
    }
    cfile.close();

    cout << "Done: " << v[2] << endl;
    return 0;
}
