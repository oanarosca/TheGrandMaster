#include <iostream>
#include <cstdlib>
#include <ctime>
#include <algorithm>

using namespace std;

int bile, locuri, incercari, m[270000][7], b[7], sol[7], v, x, p = 1, f[7];
bool marcat[270000];
int a[101][7], fa[10001][7], k;

bool cmp (int a, int b) {
  return a > b;
}

void bt (int p) {
  for (int i = 0; i <= bile-1; i++) {
    b[p] = i;
    if (p == locuri) {
      v++;
      for (int j = 1; j <= p; j++)
        m[v][j] = b[j];
    }
    else
      bt(p+1);
  }
}

bool valid (int x) {
  int poz = locuri;
  if (x <= p/10 or p <= x)
    return false;
  while (x) {
    if (x % 10 > bile-1)
      return false;
    sol[poz--] = x % 10;
    x /= 10;
  }
  return true;
}

void afis (int p) {
  for (int i = 1; i <= locuri; i++)
    cout << m[p][i] << ' ';
  cout << ' ';
  for (int i = 1; i <= locuri; i++)
    cout << fa[incercari][i] << ' ';
  cout << '\n';
}

void feedback (int p, int m[][7], int sol[]) {
  int i, j, mu[7], ms[7];
  k = 0;
  for (i = 1; i <= locuri; i++) f[i] = mu[i] = ms[i] = 0;
  for (i = 1; i <= locuri; i++)
    if (sol[i] == m[p][i])
      f[++k] = 2, mu[i] = ms[i] = 1;
  for (i = 1; i <= locuri; i++)
    for (j = 1; j <= locuri; j++)
      if (sol[i] == m[p][j] and !mu[j] and !ms[i]) {
        f[++k] = 1, ms[i] = mu[j] = 1;
        break;
      }
  sort(f+1, f+k+1, cmp);
}

bool contrazice (int p) {
  int i, j;
  for (i = incercari; i >= 1; i--) {
    feedback(i, a, m[p]);
    for (j = 1; j <= locuri; j++)
      if (f[j] != fa[i][j])
        return true;
  }
  return false;
}

int main () {
  cin >> bile >> locuri;
  for (int i = 1; i <= locuri; i++)
    p *= 10;
  bt(1);
  srand(time(NULL));
  do {
    x = rand()+p/10;
  } while (not valid(x));
  cout << x << '\n';
  for (int i = 1; i <= v; i++) {
    if (not marcat[i] and not contrazice(i)) {
      incercari++;
      for (int j = 1; j <= locuri; j++) a[incercari][j] = m[i][j];
      feedback(i, m, sol); int sum = 0;
      for (int j = 1; j <= k; j++)
        fa[incercari][j] = f[j], sum += f[j];
      afis(i);
      if (sum == locuri*2) {
        cout << incercari;
        return 0;
      }
    }
    marcat[i] = true;
  }
  return 0;
}
