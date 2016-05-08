#include <iostream>
#include <cstdlib>
#include <ctime>

using namespace std;

int bile, locuri, incercari, m[270000][7], a[7], v, sol, p = 1;

void bt (int p) {
  for (int i = 1; i <= bile; i++) {
    a[p] = i;
    if (p == locuri) {
      v++;
      for (int j = 1; j <= p; j++)
        m[v][j] = a[j];
    }
    else
      bt(p+1);
  }
}

bool valid (int x) {
  if (x >= p)
    return false;
  while (x) {
    if (x % 10 > bile-1)
      return false;
    x /= 10;
  }
  return true;
}

int main () {
  cin >> bile >> locuri;
  for (int i = 1; i <= locuri; i++)
    p *= 10;
  bt(1);
  srand(time(NULL));
  do {
    sol = rand()+p/10;
  } while (not valid(sol));
  cout << sol;
  return 0;
}
