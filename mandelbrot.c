#include <stdio.h>
#include <math.h>

int W = 100;
int H = 40;
long double speed = 1.03;
long double cr = -1.749721929742338571710438695186828716;
long double ci = 0.0000290166477536876274764422704374969315895;
//long double cr = -1.712222225;
//long double ci = 0.0;

int ct[] = {
    196,202,208,214,220,
    226,190,154,118,82,
    46,47,48,49,50,
    51,45,39,33,27,
    21,57,93,129,165,
    201,200,199,198,197
};

int colorOf(iteration) {
    return ct[iteration % 30];
}

void dot(long double r, long double i, int ic) {
    int iteration = 0;
    long double fr = 0;
    long double fi = 0;
    
    for (; ; iteration++) {
	if (sqrt(fr*fr + fi*fi) > 2) {
	    break;
	}
	
	long double fr_ = fr*fr - fi*fi;
	fi = fi*fr*2 + i;
	fr = fr_ + r;
	if (iteration > ic || sqrt(fr*fr + fi*fi) < 0.0000001) {
	    printf(" ");
	    return;
	}
    }
    
    printf("\033[48;5;%dm \033[0m", colorOf(iteration));
}

void draw(long double angle, long double fr, long double fi, long double tr, long double ti, int ic) {
    for (int y = 0; y <= H; y++) {
	for (int x = 0; x < W; x++) {
	    long double cr = (tr + fr)/2;
	    long double ci = (ti + fi)/2;
	    
	    long double rr = fr + x * fabsl(tr - fr)/W - cr;
	    long double ri = fi - y * fabsl(ti - fi)/H - ci;
	    
	    long double rr_ = rr * cos(angle) - ri * sin(angle);
	    long double ri_ = ri * cos(angle) + rr * sin(angle);
	    
	    dot(cr + rr_, ci + ri_, ic);
	}
	printf("\n");
    }
}

int main() {
    long double angle = 0;
    
    for (long double bound = 4; ; bound /= speed) {
	long double icc = 100 + sqrt(1/bound);
	int ic = icc < 50000 ? (int)icc : 50000;
	
	printf("\033[1;1f"); //cursor to top-left corner

	draw(angle+=speed-1, cr-bound, ci+bound, cr+bound, ci-bound, ic);
    }
}
