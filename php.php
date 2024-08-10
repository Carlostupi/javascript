<?php

class ErpSeniorIntegraPedido
{
    private $proposta_id;
    public function __construct($proposta_id)
    {
        $this->proposta_id = $proposta_id;
        $this->MontaPedido();
    }
    
    
    public function MontaPedido()
    {
        try {
            TTransaction::open('base');
            $Proposta = new PropostaCab($this->proposta_id);
            $P = new stdClass;
            $P->opeExe = 'I';
			$P->codEmp  = $Proposta->empresa->cd_integracao;
			$P->codFil = 1;
			$P->codCli = $Proposta->pessoa->cd_integracao;
			$P->tnsPro = '90198'; // Entrada de Pedido Produto
			$P->datEmi = date("d/m/Y");
			//<pedCli>123456</pedCli>
			$P->codCpg = $Proposta->condicao->cd_integracao;
			$P->pgtAnt = 'N'; //Obrigatório) - String(001) - Indicativo se o pedido é com pagamento antecipado - Lista: S = Sim, N = Não
			$P->pedPal = $Proposta->id;
			$P->codRep = $Proposta->representante->cd_integracao;
			$P->temPar = 'N';
			$P->fecPed = 'N';
			$P->cifFob = 'F'; //Obrigatório) - String(001) - Indicativo se o frete é CIF ou FOB - Lista: C = Por conta do emitente, F = Por conta do destinatário, T = Por conta de terceiros, X = Sem frete
			//$P->obsPed = strip_tags($Proposta->obs);
			$Itens = [];
			$PropostaItens = PropostaItem::where('proposta_id','=',$Proposta->id)->load();
			foreach($PropostaItens as $l){
			    $I = new stdClass;
			    $I->opeExe = $P->opeExe;
				//$I->seqIsp = '0';
				$I->codPro = $l->produto->cd_integracao;
				$I->codDer = 'U';
				//<cplIsp>teste</cplIsp>
				$I->qtdPed = number_format($l->qtd, 5, ',', '');
				$I->uniMed = $l->unidade->un;
				$I->datEnt = (empty($l->dt_entrega)) ? date("d/m/Y") : TDate::date2br($l->dt_entrega);
				$I->preUni = number_format($l->valor_unitario_final, 10, ',', '');
				//<vlrLiq>1</vlrLiq>
				$I->vlrLpr = number_format($l->valor_bruto_final, 2, ',', '');
				$I->rateio =   			                  [   
    			                    'numPrj' => 126,
                                    'codFpj' => 1,
                                    'ctaFin' => 311004,
                                    'ctaRed' => 311004,
                                    'codCcu' => 901,
                                    'perCta' => 100,
                                    'perRat' => 100
                                  			               ];
				$Itens[] = $I;
			}
			$P = (array)$P;
			$P['produto'] = $Itens;
			
			
			$Pedido = new stdClass;
			$Pedido->ignorarErrosItens = 'S';
            $Pedido->ignorarErrosParcela = 'S';
            $Pedido->ignorarErrosPedidos = 'S';
            $Pedido->ignorarPedidoBloqueado = 'S';
            $Pedido->inserirApenasPedidoCompleto = 'S';
            $Pedido = (array)$Pedido;
            $Pedido['pedido'] = $P;
			
            TTransaction::close();
            
            $Enviar = new ErpSenior;
            $retorno = $Enviar->EnviarPedido($Pedido);
            
        } catch (Exception $e) {
            TTransaction::rollback();
            echo $e->getMessage();
        }
    }
}
