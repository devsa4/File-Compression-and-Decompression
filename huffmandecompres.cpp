#include <iostream>
#include <fstream>
#include <unordered_map>
#include <string>
#include <bitset>
using namespace std;

unordered_map<string, char> load(const string& f) {
    ifstream in(f);
    unordered_map<string, char> m;
    string a, b;
    while (in >> a >> b) {
        char c;
        if (a == "space") c = ' ';
        else if (a == "newline") c = '\n';
        else c = a[0];
        m[b] = c;
    }
    return m;
}

string rd(const string& f, int& pad) {
    ifstream in(f, ios::binary);
    pad = in.get();
    string bits;
    char ch;
    while (in.get(ch)) {
        bitset<8> b(static_cast<unsigned char>(ch));
        bits += b.to_string();
    }
    in.close();
    return bits.substr(0, bits.size() - pad);
}

int main(int a, char* v[]) {
    if (a != 3) {
        cerr << "Usage: ./decompress in.bin out.txt\n";
        return 1;
    }

    unordered_map<string, char> m = load("code.txt");
    int pad = 0;
    string b = rd(v[1], pad);

    ofstream out(v[2]);
    string cur;
    for (char x : b) {
        cur += x;
        if (m.count(cur)) {
            out << m[cur];
            cur.clear();
        }
    }
    out.close();
    cout << "Done: " << v[2] << endl;
    return 0;
}
