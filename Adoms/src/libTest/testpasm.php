<?php

namespace Adoms\pasm;

require_once '\Adoms\pasm\PASM.php';

 class PASMTest extends PASM {

	public function testCheckForFunctionget() 
	{
		$obj = new PASM();
		$testReturn = $obj->get();
	}
	public function testCheckForFunctionchar_adjust_addition() 
	{
		$obj = new PASM();
		$testReturn = $obj->char_adjust_addition();
	}
	public function testCheckForFunctioncarry_add() 
	{
		$obj = new PASM();
		$testReturn = $obj->carry_add();
	}
	public function testCheckForFunctionadd() 
	{
		$obj = new PASM();
		$testReturn = $obj->add();
	}
	public function testCheckForFunctionand() 
	{
		$obj = new PASM();
		$testReturn = $obj->and();
	}
	public function testCheckForFunctionchmod() 
	{
		$obj = new PASM();
		$testReturn = $obj->chmod();
	}
	public function testCheckForFunctionbit_scan_fwd() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_scan_fwd();
	}
	public function testCheckForFunctionbit_scan_rvr() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_scan_rvr();
	}
	public function testCheckForFunctionbyte_rvr() 
	{
		$obj = new PASM();
		$testReturn = $obj->byte_rvr();
	}
	public function testCheckForFunctionbit_test() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_test();
	}
	public function testCheckForFunctionbit_test_comp() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_test_comp();
	}
	public function testCheckForFunctionbit_test_reset() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_test_reset();
	}
	public function testCheckForFunctionbit_test_set() 
	{
		$obj = new PASM();
		$testReturn = $obj->bit_test_set();
	}
	public function testCheckForFunctioncall() 
	{
		$obj = new PASM();
		$testReturn = $obj->call();
	}
	public function testCheckForFunctioncmp_mov_a() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_a();
	}
	public function testCheckForFunctioncmp_mov_ae() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_ae();
	}
	public function testCheckForFunctioncmp_mov_b() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_b();
	}
	public function testCheckForFunctioncmp_mov_be() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_be();
	}
	public function testCheckForFunctioncmp_mov_e() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_e();
	}
	public function testCheckForFunctioncmp_mov_nz() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_nz();
	}
	public function testCheckForFunctioncmp_mov_pe() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_pe();
	}
	public function testCheckForFunctioncmp_mov_po() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_po();
	}
	public function testCheckForFunctioncmp_mov_s() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_s();
	}
	public function testCheckForFunctioncmp_mov_z() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_mov_z();
	}
	public function testCheckForFunctionmov() 
	{
		$obj = new PASM();
		$testReturn = $obj->mov();
	}
	public function testCheckForFunctionmovabs() 
	{
		$obj = new PASM();
		$testReturn = $obj->movabs();
	}
	public function testCheckForFunctionclear_carry() 
	{
		$obj = new PASM();
		$testReturn = $obj->clear_carry();
	}
	public function testCheckForFunctionclear_registers() 
	{
		$obj = new PASM();
		$testReturn = $obj->clear_registers();
	}
	public function testCheckForFunctioncomp_carry() 
	{
		$obj = new PASM();
		$testReturn = $obj->comp_carry();
	}
	public function testCheckForFunctioncmp_e() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_e();
	}
	public function testCheckForFunctioncmp_same() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_same();
	}
	public function testCheckForFunctioncmp_xchg() 
	{
		$obj = new PASM();
		$testReturn = $obj->cmp_xchg();
	}
	public function testCheckForFunctiondecr() 
	{
		$obj = new PASM();
		$testReturn = $obj->decr();
	}
	public function testCheckForFunctiondivide() 
	{
		$obj = new PASM();
		$testReturn = $obj->divide();
	}
	public function testCheckForFunctionabsf() 
	{
		$obj = new PASM();
		$testReturn = $obj->absf();
	}
	public function testCheckForFunctionaddf() 
	{
		$obj = new PASM();
		$testReturn = $obj->addf();
	}
	public function testCheckForFunctionround() 
	{
		$obj = new PASM();
		$testReturn = $obj->round();
	}
	public function testCheckForFunctionround_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->round_pop();
	}
	public function testCheckForFunctionneg() 
	{
		$obj = new PASM();
		$testReturn = $obj->neg();
	}
	public function testCheckForFunctionstack_cmov_b() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_b();
	}
	public function testCheckForFunctionstack_cmov_be() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_be();
	}
	public function testCheckForFunctionstack_cmov_e() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_e();
	}
	public function testCheckForFunctionstack_cmov_nb() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_nb();
	}
	public function testCheckForFunctionstack_cmov_nbe() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_nbe();
	}
	public function testCheckForFunctionstack_cmov_ne() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_cmov_ne();
	}
	public function testCheckForFunctionfcomp() 
	{
		$obj = new PASM();
		$testReturn = $obj->fcomp();
	}
	public function testCheckForFunctioncosine() 
	{
		$obj = new PASM();
		$testReturn = $obj->cosine();
	}
	public function testCheckForFunctionstack_pnt_rev() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_pnt_rev();
	}
	public function testCheckForFunctionfdiv() 
	{
		$obj = new PASM();
		$testReturn = $obj->fdiv();
	}
	public function testCheckForFunctionfdiv_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->fdiv_pop();
	}
	public function testCheckForFunctionfdiv_rev() 
	{
		$obj = new PASM();
		$testReturn = $obj->fdiv_rev();
	}
	public function testCheckForFunctionfdiv_rev_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->fdiv_rev_pop();
	}
	public function testCheckForFunctionadd_stack() 
	{
		$obj = new PASM();
		$testReturn = $obj->add_stack();
	}
	public function testCheckForFunctionficomp() 
	{
		$obj = new PASM();
		$testReturn = $obj->ficomp();
	}
	public function testCheckForFunctionrecvr_stack() 
	{
		$obj = new PASM();
		$testReturn = $obj->recvr_stack();
	}
	public function testCheckForFunctionstack_load() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_load();
	}
	public function testCheckForFunctionstack_mrg() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_mrg();
	}
	public function testCheckForFunctionfmul() 
	{
		$obj = new PASM();
		$testReturn = $obj->fmul();
	}
	public function testCheckForFunctionstack_pnt_fwd() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_pnt_fwd();
	}
	public function testCheckForFunctionstore_int() 
	{
		$obj = new PASM();
		$testReturn = $obj->store_int();
	}
	public function testCheckForFunctionstore_int_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->store_int_pop();
	}
	public function testCheckForFunctionsubtract_rev() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_rev();
	}
	public function testCheckForFunctionsubtract() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract();
	}
	public function testCheckForFunctionfld1() 
	{
		$obj = new PASM();
		$testReturn = $obj->fld1();
	}
	public function testCheckForFunctionload_logl2() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_logl2();
	}
	public function testCheckForFunctionload_logl2t() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_logl2t();
	}
	public function testCheckForFunctionload_loglg2() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_loglg2();
	}
	public function testCheckForFunctionload_ln2() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_ln2();
	}
	public function testCheckForFunctionload_pi() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_pi();
	}
	public function testCheckForFunctionfloat_test() 
	{
		$obj = new PASM();
		$testReturn = $obj->float_test();
	}
	public function testCheckForFunctionfmul_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->fmul_pop();
	}
	public function testCheckForFunctionclean_exceptions() 
	{
		$obj = new PASM();
		$testReturn = $obj->clean_exceptions();
	}
	public function testCheckForFunctionclean_reg() 
	{
		$obj = new PASM();
		$testReturn = $obj->clean_reg();
	}
	public function testCheckForFunctionfnop() 
	{
		$obj = new PASM();
		$testReturn = $obj->fnop();
	}
	public function testCheckForFunctionfpatan() 
	{
		$obj = new PASM();
		$testReturn = $obj->fpatan();
	}
	public function testCheckForFunctionfptan() 
	{
		$obj = new PASM();
		$testReturn = $obj->fptan();
	}
	public function testCheckForFunctionfprem() 
	{
		$obj = new PASM();
		$testReturn = $obj->fprem();
	}
	public function testCheckForFunctionfrndint() 
	{
		$obj = new PASM();
		$testReturn = $obj->frndint();
	}
	public function testCheckForFunctionfrstor() 
	{
		$obj = new PASM();
		$testReturn = $obj->frstor();
	}
	public function testCheckForFunctionfsin() 
	{
		$obj = new PASM();
		$testReturn = $obj->fsin();
	}
	public function testCheckForFunctionfsincos() 
	{
		$obj = new PASM();
		$testReturn = $obj->fsincos();
	}
	public function testCheckForFunctionfscale() 
	{
		$obj = new PASM();
		$testReturn = $obj->fscale();
	}
	public function testCheckForFunctionfsqrt() 
	{
		$obj = new PASM();
		$testReturn = $obj->fsqrt();
	}
	public function testCheckForFunctionfst() 
	{
		$obj = new PASM();
		$testReturn = $obj->fst();
	}
	public function testCheckForFunctionfstcw() 
	{
		$obj = new PASM();
		$testReturn = $obj->fstcw();
	}
	public function testCheckForFunctionfstp() 
	{
		$obj = new PASM();
		$testReturn = $obj->fstp();
	}
	public function testCheckForFunctionsubtract_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_pop();
	}
	public function testCheckForFunctionsubtract_rev_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_rev_pop();
	}
	public function testCheckForFunctionftst() 
	{
		$obj = new PASM();
		$testReturn = $obj->ftst();
	}
	public function testCheckForFunctionfucom() 
	{
		$obj = new PASM();
		$testReturn = $obj->fucom();
	}
	public function testCheckForFunctionfucomp() 
	{
		$obj = new PASM();
		$testReturn = $obj->fucomp();
	}
	public function testCheckForFunctionfucompp() 
	{
		$obj = new PASM();
		$testReturn = $obj->fucompp();
	}
	public function testCheckForFunctionfxam() 
	{
		$obj = new PASM();
		$testReturn = $obj->fxam();
	}
	public function testCheckForFunctionfxch() 
	{
		$obj = new PASM();
		$testReturn = $obj->fxch();
	}
	public function testCheckForFunctionfxtract() 
	{
		$obj = new PASM();
		$testReturn = $obj->fxtract();
	}
	public function testCheckForFunctionfyl2x() 
	{
		$obj = new PASM();
		$testReturn = $obj->fyl2x();
	}
	public function testCheckForFunctionfyl2xp1() 
	{
		$obj = new PASM();
		$testReturn = $obj->fyl2xp1();
	}
	public function testCheckForFunctionhlt() 
	{
		$obj = new PASM();
		$testReturn = $obj->hlt();
	}
	public function testCheckForFunctionidiv() 
	{
		$obj = new PASM();
		$testReturn = $obj->idiv();
	}
	public function testCheckForFunctionimul() 
	{
		$obj = new PASM();
		$testReturn = $obj->imul();
	}
	public function testCheckForFunctionin() 
	{
		$obj = new PASM();
		$testReturn = $obj->in();
	}
	public function testCheckForFunctioninc() 
	{
		$obj = new PASM();
		$testReturn = $obj->inc();
	}
	public function testCheckForFunctionin_b() 
	{
		$obj = new PASM();
		$testReturn = $obj->in_b();
	}
	public function testCheckForFunctionin_d() 
	{
		$obj = new PASM();
		$testReturn = $obj->in_d();
	}
	public function testCheckForFunctionin_w() 
	{
		$obj = new PASM();
		$testReturn = $obj->in_w();
	}
	public function testCheckForFunctionin_q() 
	{
		$obj = new PASM();
		$testReturn = $obj->in_q();
	}
	public function testCheckForFunctioninterrupt() 
	{
		$obj = new PASM();
		$testReturn = $obj->interrupt();
	}
	public function testCheckForFunctionwrite() 
	{
		$obj = new PASM();
		$testReturn = $obj->write();
	}
	public function testCheckForFunctionread() 
	{
		$obj = new PASM();
		$testReturn = $obj->read();
	}
	public function testCheckForFunctionmov_buffer() 
	{
		$obj = new PASM();
		$testReturn = $obj->mov_buffer();
	}
	public function testCheckForFunctionja() 
	{
		$obj = new PASM();
		$testReturn = $obj->ja();
	}
	public function testCheckForFunctionjae() 
	{
		$obj = new PASM();
		$testReturn = $obj->jae();
	}
	public function testCheckForFunctionjb() 
	{
		$obj = new PASM();
		$testReturn = $obj->jb();
	}
	public function testCheckForFunctionjbe() 
	{
		$obj = new PASM();
		$testReturn = $obj->jbe();
	}
	public function testCheckForFunctionjc() 
	{
		$obj = new PASM();
		$testReturn = $obj->jc();
	}
	public function testCheckForFunctionjcxz() 
	{
		$obj = new PASM();
		$testReturn = $obj->jcxz();
	}
	public function testCheckForFunctionje() 
	{
		$obj = new PASM();
		$testReturn = $obj->je();
	}
	public function testCheckForFunctionjg() 
	{
		$obj = new PASM();
		$testReturn = $obj->jg();
	}
	public function testCheckForFunctionjge() 
	{
		$obj = new PASM();
		$testReturn = $obj->jge();
	}
	public function testCheckForFunctionjl() 
	{
		$obj = new PASM();
		$testReturn = $obj->jl();
	}
	public function testCheckForFunctionjle() 
	{
		$obj = new PASM();
		$testReturn = $obj->jle();
	}
	public function testCheckForFunctionjmp() 
	{
		$obj = new PASM();
		$testReturn = $obj->jmp();
	}
	public function testCheckForFunctionjnae() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnae();
	}
	public function testCheckForFunctionjnb() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnb();
	}
	public function testCheckForFunctionjnbe() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnbe();
	}
	public function testCheckForFunctionjnc() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnc();
	}
	public function testCheckForFunctionjne() 
	{
		$obj = new PASM();
		$testReturn = $obj->jne();
	}
	public function testCheckForFunctionjng() 
	{
		$obj = new PASM();
		$testReturn = $obj->jng();
	}
	public function testCheckForFunctionjnl() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnl();
	}
	public function testCheckForFunctionjno() 
	{
		$obj = new PASM();
		$testReturn = $obj->jno();
	}
	public function testCheckForFunctionjns() 
	{
		$obj = new PASM();
		$testReturn = $obj->jns();
	}
	public function testCheckForFunctionjnz() 
	{
		$obj = new PASM();
		$testReturn = $obj->jnz();
	}
	public function testCheckForFunctionjgz() 
	{
		$obj = new PASM();
		$testReturn = $obj->jgz();
	}
	public function testCheckForFunctionjlz() 
	{
		$obj = new PASM();
		$testReturn = $obj->jlz();
	}
	public function testCheckForFunctionjzge() 
	{
		$obj = new PASM();
		$testReturn = $obj->jzge();
	}
	public function testCheckForFunctionjzle() 
	{
		$obj = new PASM();
		$testReturn = $obj->jzle();
	}
	public function testCheckForFunctionjo() 
	{
		$obj = new PASM();
		$testReturn = $obj->jo();
	}
	public function testCheckForFunctionjpe() 
	{
		$obj = new PASM();
		$testReturn = $obj->jpe();
	}
	public function testCheckForFunctionjpo() 
	{
		$obj = new PASM();
		$testReturn = $obj->jpo();
	}
	public function testCheckForFunctionjz() 
	{
		$obj = new PASM();
		$testReturn = $obj->jz();
	}
	public function testCheckForFunctionload_all_flags() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_all_flags();
	}
	public function testCheckForFunctionend() 
	{
		$obj = new PASM();
		$testReturn = $obj->end();
	}
	public function testCheckForFunctionleave() 
	{
		$obj = new PASM();
		$testReturn = $obj->leave();
	}
	public function testCheckForFunctionmov_ecx() 
	{
		$obj = new PASM();
		$testReturn = $obj->mov_ecx();
	}
	public function testCheckForFunctionmov_ah() 
	{
		$obj = new PASM();
		$testReturn = $obj->mov_ah();
	}
	public function testCheckForFunctionload_str() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_str();
	}
	public function testCheckForFunctioncoast() 
	{
		$obj = new PASM();
		$testReturn = $obj->coast();
	}
	public function testCheckForFunctionloop() 
	{
		$obj = new PASM();
		$testReturn = $obj->loop();
	}
	public function testCheckForFunctionloope() 
	{
		$obj = new PASM();
		$testReturn = $obj->loope();
	}
	public function testCheckForFunctionloopne() 
	{
		$obj = new PASM();
		$testReturn = $obj->loopne();
	}
	public function testCheckForFunctionloopnz() 
	{
		$obj = new PASM();
		$testReturn = $obj->loopnz();
	}
	public function testCheckForFunctionloopz() 
	{
		$obj = new PASM();
		$testReturn = $obj->loopz();
	}
	public function testCheckForFunctionmul() 
	{
		$obj = new PASM();
		$testReturn = $obj->mul();
	}
	public function testCheckForFunctionmovs() 
	{
		$obj = new PASM();
		$testReturn = $obj->movs();
	}
	public function testCheckForFunctionreset_sp() 
	{
		$obj = new PASM();
		$testReturn = $obj->reset_sp();
	}
	public function testCheckForFunctionmovr() 
	{
		$obj = new PASM();
		$testReturn = $obj->movr();
	}
	public function testCheckForFunctionaddr() 
	{
		$obj = new PASM();
		$testReturn = $obj->addr();
	}
	public function testCheckForFunctionmwait() 
	{
		$obj = new PASM();
		$testReturn = $obj->mwait();
	}
	public function testCheckForFunctionnop() 
	{
		$obj = new PASM();
		$testReturn = $obj->nop();
	}
	public function testCheckForFunctionnot() 
	{
		$obj = new PASM();
		$testReturn = $obj->not();
	}
	public function testCheckForFunctionor() 
	{
		$obj = new PASM();
		$testReturn = $obj->or();
	}
	public function testCheckForFunctionout() 
	{
		$obj = new PASM();
		$testReturn = $obj->out();
	}
	public function testCheckForFunctionobj_push() 
	{
		$obj = new PASM();
		$testReturn = $obj->obj_push();
	}
	public function testCheckForFunctionpop() 
	{
		$obj = new PASM();
		$testReturn = $obj->pop();
	}
	public function testCheckForFunctionpush() 
	{
		$obj = new PASM();
		$testReturn = $obj->push();
	}
	public function testCheckForFunctionshift_left() 
	{
		$obj = new PASM();
		$testReturn = $obj->shift_left();
	}
	public function testCheckForFunctionshift_right() 
	{
		$obj = new PASM();
		$testReturn = $obj->shift_right();
	}
	public function testCheckForFunctionmv_shift_left() 
	{
		$obj = new PASM();
		$testReturn = $obj->mv_shift_left();
	}
	public function testCheckForFunctionmv_shift_right() 
	{
		$obj = new PASM();
		$testReturn = $obj->mv_shift_right();
	}
	public function testCheckForFunctionrun() 
	{
		$obj = new PASM();
		$testReturn = $obj->run();
	}
	public function testCheckForFunctionrun_pop() 
	{
		$obj = new PASM();
		$testReturn = $obj->run_pop();
	}
	public function testCheckForFunctionset_flags() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_flags();
	}
	public function testCheckForFunctionbitwisel() 
	{
		$obj = new PASM();
		$testReturn = $obj->bitwisel();
	}
	public function testCheckForFunctionbitewiser() 
	{
		$obj = new PASM();
		$testReturn = $obj->bitewiser();
	}
	public function testCheckForFunctionscan_str() 
	{
		$obj = new PASM();
		$testReturn = $obj->scan_str();
	}
	public function testCheckForFunctionreset_str() 
	{
		$obj = new PASM();
		$testReturn = $obj->reset_str();
	}
	public function testCheckForFunctionset() 
	{
		$obj = new PASM();
		$testReturn = $obj->set();
	}
	public function testCheckForFunctionset_ecx_adx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_adx();
	}
	public function testCheckForFunctionset_ecx_rdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_rdx();
	}
	public function testCheckForFunctionset_ecx_bdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_bdx();
	}
	public function testCheckForFunctionset_ecx_cdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_cdx();
	}
	public function testCheckForFunctionset_ecx_ddx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_ddx();
	}
	public function testCheckForFunctionset_ecx_edx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ecx_edx();
	}
	public function testCheckForFunctionset_ah_adx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_adx();
	}
	public function testCheckForFunctionset_ah_rdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_rdx();
	}
	public function testCheckForFunctionset_ah_bdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_bdx();
	}
	public function testCheckForFunctionset_ah_cdx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_cdx();
	}
	public function testCheckForFunctionset_ah_ddx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_ddx();
	}
	public function testCheckForFunctionset_ah_edx() 
	{
		$obj = new PASM();
		$testReturn = $obj->set_ah_edx();
	}
	public function testCheckForFunctionseta() 
	{
		$obj = new PASM();
		$testReturn = $obj->seta();
	}
	public function testCheckForFunctionsetae() 
	{
		$obj = new PASM();
		$testReturn = $obj->setae();
	}
	public function testCheckForFunctionsetb() 
	{
		$obj = new PASM();
		$testReturn = $obj->setb();
	}
	public function testCheckForFunctionsetbe() 
	{
		$obj = new PASM();
		$testReturn = $obj->setbe();
	}
	public function testCheckForFunctionsetc() 
	{
		$obj = new PASM();
		$testReturn = $obj->setc();
	}
	public function testCheckForFunctionsete() 
	{
		$obj = new PASM();
		$testReturn = $obj->sete();
	}
	public function testCheckForFunctionsetg() 
	{
		$obj = new PASM();
		$testReturn = $obj->setg();
	}
	public function testCheckForFunctionsetge() 
	{
		$obj = new PASM();
		$testReturn = $obj->setge();
	}
	public function testCheckForFunctionsetl() 
	{
		$obj = new PASM();
		$testReturn = $obj->setl();
	}
	public function testCheckForFunctionsetle() 
	{
		$obj = new PASM();
		$testReturn = $obj->setle();
	}
	public function testCheckForFunctionsetna() 
	{
		$obj = new PASM();
		$testReturn = $obj->setna();
	}
	public function testCheckForFunctionsetnae() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnae();
	}
	public function testCheckForFunctionsetnb() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnb();
	}
	public function testCheckForFunctionsetnbe() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnbe();
	}
	public function testCheckForFunctionsetnc() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnc();
	}
	public function testCheckForFunctionsetne() 
	{
		$obj = new PASM();
		$testReturn = $obj->setne();
	}
	public function testCheckForFunctionsetng() 
	{
		$obj = new PASM();
		$testReturn = $obj->setng();
	}
	public function testCheckForFunctionsetnge() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnge();
	}
	public function testCheckForFunctionsetnl() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnl();
	}
	public function testCheckForFunctionsetnle() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnle();
	}
	public function testCheckForFunctionsetno() 
	{
		$obj = new PASM();
		$testReturn = $obj->setno();
	}
	public function testCheckForFunctionsetnp() 
	{
		$obj = new PASM();
		$testReturn = $obj->setnp();
	}
	public function testCheckForFunctionsetns() 
	{
		$obj = new PASM();
		$testReturn = $obj->setns();
	}
	public function testCheckForFunctionseto() 
	{
		$obj = new PASM();
		$testReturn = $obj->seto();
	}
	public function testCheckForFunctionsetp() 
	{
		$obj = new PASM();
		$testReturn = $obj->setp();
	}
	public function testCheckForFunctionsetpe() 
	{
		$obj = new PASM();
		$testReturn = $obj->setpe();
	}
	public function testCheckForFunctionsetpo() 
	{
		$obj = new PASM();
		$testReturn = $obj->setpo();
	}
	public function testCheckForFunctionsets() 
	{
		$obj = new PASM();
		$testReturn = $obj->sets();
	}
	public function testCheckForFunctionsetz() 
	{
		$obj = new PASM();
		$testReturn = $obj->setz();
	}
	public function testCheckForFunctionstc() 
	{
		$obj = new PASM();
		$testReturn = $obj->stc();
	}
	public function testCheckForFunctionadd_to_buffer() 
	{
		$obj = new PASM();
		$testReturn = $obj->add_to_buffer();
	}
	public function testCheckForFunctionclear_buffer() 
	{
		$obj = new PASM();
		$testReturn = $obj->clear_buffer();
	}
	public function testCheckForFunctionsave_stack_file() 
	{
		$obj = new PASM();
		$testReturn = $obj->save_stack_file();
	}
	public function testCheckForFunctionsubtract_byte() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_byte();
	}
	public function testCheckForFunctionsubtract_word() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_word();
	}
	public function testCheckForFunctionsubtract_double() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_double();
	}
	public function testCheckForFunctionsubtract_quad() 
	{
		$obj = new PASM();
		$testReturn = $obj->subtract_quad();
	}
	public function testCheckForFunctionload_cl() 
	{
		$obj = new PASM();
		$testReturn = $obj->load_cl();
	}
	public function testCheckForFunctiontest_compare() 
	{
		$obj = new PASM();
		$testReturn = $obj->test_compare();
	}
	public function testCheckForFunctionthread() 
	{
		$obj = new PASM();
		$testReturn = $obj->thread();
	}
	public function testCheckForFunctionxadd() 
	{
		$obj = new PASM();
		$testReturn = $obj->xadd();
	}
	public function testCheckForFunctionexchange() 
	{
		$obj = new PASM();
		$testReturn = $obj->exchange();
	}
	public function testCheckForFunctionxor() 
	{
		$obj = new PASM();
		$testReturn = $obj->xor();
	}
	public function testCheckForFunctionpopcnt() 
	{
		$obj = new PASM();
		$testReturn = $obj->popcnt();
	}
	public function testCheckForFunctionstack_func() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_func();
	}
	public function testCheckForFunctionstack_func_pos() 
	{
		$obj = new PASM();
		$testReturn = $obj->stack_func_pos();
	}
}
?>