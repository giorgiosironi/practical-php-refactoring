<?php
class Test extends PHPUnit_Framework_TestCase
{
    public function test()
    {
        $classifier = new BayesClassifier();
        $classifier->setPriors(array('spam' => 0.2, 'notspam' => 0.8));
        $classifier->addFeature('free', array(0.9, 0.1));
        $classifier->addFeature('win', array(0.99, 0.01));
        $classifier->addFeature('money', array(0.8, 0.2));
        $classifier->addFeature('social', array(0.9, 0.1));
        $classifier->addFeature('prince', array(0.9, 0.1));
        $classifier->addFeature('likelihood', array(0.01, 0.99));
        $classifier->addFeature('hitchhiker', array(0.1, 0.9));
        $result = $classifier->classify('win free money by sending $10,000 to a Nigerian prince through our social network!');
        $this->assertEquals('spam', $result);
        // forgive me for putting everything in one test for brevity
        $result = $classifier->classify('have you finished studying Bayes and maximum likelihood?');
        $this->assertEquals('notspam', $result);
    }
}

class BayesClassifier
{
    private $priors;
    private $features;

    public function setPriors($priors)
    {
        $this->priors = $priors;
    }

    public function addFeature($word, $likelihoods)
    {
        $this->features[$word] = $likelihoods;
    }

    public function classify($mailText)
    {
        $discriminators = array();
        foreach ($this->priors as $result => $prior) {
            $discriminators[$result] = $prior;
        }
        $words = explode(' ', $mailText);
        foreach ($words as $word) {
            if (isset($this->features[$word])) {
                $i = 0;
                foreach ($this->priors as $result => $prior) {
                    $discriminators[$result] = $discriminators[$result] * $this->features[$word][$i];
                    $i++;
                }
            }
        }
        return array_search(max($discriminators), $discriminators);
    }
}
