<?php

namespace App\Controller;

use App\Entity\Member;
use App\Repository\MemberRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/members')]
class MemberController extends AbstractController
{
    // GET ALL
    #[Route('', name: 'members_index', methods: ['GET'])]
    public function index(MemberRepository $memberRepository): JsonResponse
    {
        $members = $memberRepository->findAll();
        return $this->json($members, 200, [], ['groups' => 'member:read']);
    }

    // GET ONE
    #[Route('/{id}', name: 'members_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(Member $member): JsonResponse
    {
        return $this->json($member, 200, [], ['groups' => 'member:read']);
    }

    // CREATE
    #[Route('', name: 'members_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['name']) || !isset($data['image'])) {
            return $this->json(['error' => 'Missing data'], 400);
        }

        $member = new Member();
        $member->setName($data['name']);
        $member->setImage($data['image']);
        $member->setCreatedAt(new \DateTimeImmutable());

        $em->persist($member);
        $em->flush();

        return $this->json($member, 201, [], ['groups' => 'member:read']);
    }

    // UPDATE
    #[Route('/{id}', name: 'members_update', methods: ['PUT'], requirements: ['id' => '\d+'])]
    public function update(Request $request, Member $member, EntityManagerInterface $em): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (isset($data['name'])) $member->setName($data['name']);
        if (isset($data['image'])) $member->setImage($data['image']);

        $em->flush();
        return $this->json($member, 200, [], ['groups' => 'member:read']);
    }

    // DELETE
    #[Route('/{id}', name: 'members_delete', methods: ['DELETE'], requirements: ['id' => '\d+'])]
    public function delete(int $id, MemberRepository $repo, EntityManagerInterface $em): JsonResponse
    {
        $member = $repo->find($id);
        if (!$member) return $this->json(['error' => 'Member not found'], 404);

        $em->remove($member);
        $em->flush();

        return $this->json(['message' => 'Deleted'], 200);
    }
}