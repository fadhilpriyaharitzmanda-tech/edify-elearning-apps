"use client";

import React from "react";
import { cn } from "@/lib/utils";
import {
  ArrowRight,
  Clock,
  Users,
  Award,
  Sparkles,
  Zap,
  Star,
  BookOpen,
} from "lucide-react";

export interface CourseCardSpecs {
  hours: string;
  tutorSessions: string;
  benefits: string;
}

export interface PerspectiveFlipCardProps {
  className?: string;
  front: React.ReactNode;
  back: React.ReactNode;
  h?: string;
  w?: string;
}

/**
 * Card 14 - Perspective Course Flip Card
 * Uses 3D perspective depth, real rating on front, and detailed tutoring/specs on back.
 */
export function PerspectiveFlipCard({
  className,
  front,
  back,
  h = "h-[520px]",
  w = "w-[360px]",
}: PerspectiveFlipCardProps) {
  return (
    <div className={cn("group/p-card [perspective:2000px]", h, w, className)}>
      <div
        className={cn(
          "relative h-full w-full transition-all duration-700 [transform-style:preserve-3d] group-hover/p-card:[transform:rotateY(180deg)]",
          "rounded-2xl cursor-pointer",
        )}
      >
        {/* Front Face: Course Overview (Tone 1: Elevated Surface, No Outer Border) */}
        <div className="absolute inset-0 size-full rounded-2xl border-none bg-card text-card-foreground [transform-style:preserve-3d] [backface-visibility:hidden] shadow-md transition-all duration-300 group-hover/p-card:shadow-2xl">
          <div className="size-full [transform-style:preserve-3d] p-3.5 flex flex-col justify-between">
            {front}
          </div>
        </div>

        {/* Back Face: Course Specs, Tutoring & Benefits (Tone 1 Base, No Outer Border) */}
        <div className="absolute inset-0 size-full rounded-2xl border-none bg-card text-card-foreground [transform-style:preserve-3d] [backface-visibility:hidden] [transform:rotateY(180deg)] shadow-2xl">
          <div className="size-full [transform-style:preserve-3d] p-7 text-center flex flex-col items-center justify-between">
            {back}
          </div>
        </div>
      </div>
    </div>
  );
}

export interface CourseItemProps {
  id: number;
  title: string;
  category: string;
  image: string;
  rating: string;
  reviewsCount: string;
  hours: string;
  tutorSessions: string;
  benefits: string;
  description: string;
  price: string;
  originalPrice?: string;
  href?: string;
}

export function CoursePerspectiveCard({
  title = "Dasar JavaScript & Interaktivitas Web",
  category = "JavaScript",
  image = "https://images.unsplash.com/photo-1555066931-4365d14bab8c?auto=format&fit=crop&w=800&q=80",
  rating = "5.0",
  reviewsCount = "310+ Ulasan",
  hours = "24 Jam",
  tutorSessions = "10x Sesi",
  benefits = "5 Proyek Riil",
  description = "Akses materi seumur hidup, code review personal dari mentor praktisi, forum diskusi privat, dan sertifikat resmi penunjang karier.",
  price = "Rp 99.000",
  originalPrice = "Rp 199.000",
  href = "/courses",
}: Partial<CourseItemProps>) {
  const front = (
    <div className="size-full flex flex-col justify-between [transform-style:preserve-3d]">
      {/* Image Section (Z: 50px) */}
      <div className="relative h-56 w-full [transform-style:preserve-3d] [transform:translateZ(45px)]">
        <div className="absolute inset-0 rounded-xl bg-muted overflow-hidden">
          <img
            src={image}
            alt={title}
            className="h-full w-full object-cover transition duration-700 group-hover/p-card:scale-110"
            loading="lazy"
          />
        </div>

        {/* Floating Rating Badge (Z: 80px - Tone 2 Frosted Pill, No Border) */}
        <div className="absolute bottom-3 left-3 flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-slate-950/85 backdrop-blur-md text-[11px] font-semibold text-white shadow-lg [transform:translateZ(75px)]">
          <Star className="size-3.5 fill-amber-400 text-amber-400" />
          <span>{rating} ({reviewsCount})</span>
        </div>

        {/* Category Pill (Z: 80px - Vivid Brand Pill, No Border) */}
        <div className="absolute top-3 right-3 px-3 py-1 rounded-full bg-primary text-white text-[10px] font-bold tracking-wide uppercase shadow-md shadow-primary/30 [transform:translateZ(75px)]">
          {category}
        </div>
      </div>

      {/* Content Section (Z: 60px) */}
      <div className="flex flex-col justify-between flex-grow pt-4 pb-2 [transform-style:preserve-3d]">
        <div className="space-y-1.5 [transform-style:preserve-3d] [transform:translateZ(55px)] text-left">
          <div className="flex items-center gap-1.5 text-primary text-xs font-semibold tracking-wide">
            <Sparkles className="size-3.5" />
            <span>Kursus Pilihan Industri</span>
          </div>
          <h3 className="text-xl font-bold tracking-tight text-foreground transition duration-300 group-hover/p-card:text-primary leading-snug line-clamp-2">
            {title}
          </h3>
          <p className="text-xs font-medium text-muted-foreground flex items-center gap-1.5 pt-1">
            <BookOpen className="size-3.5 text-primary" />
            Kurikulum Standar Industri Edify
          </p>
        </div>

        {/* Price & Hover Prompt (Z: 40px - Clean Layout without border) */}
        <div className="pt-2 flex items-center justify-between text-xs font-semibold [transform:translateZ(40px)]">
          <div>
            {originalPrice && (
              <span className="text-[11px] text-muted-foreground line-through block">
                {originalPrice}
              </span>
            )}
            <span className="text-base font-extrabold text-foreground">
              {price}
            </span>
          </div>
          <div className="flex items-center gap-1 text-primary group-hover/p-card:translate-x-1 transition-transform">
            <span>Detail Fasilitas</span>
            <ArrowRight className="size-3.5" />
          </div>
        </div>
      </div>
    </div>
  );

  const back = (
    <div className="size-full flex flex-col items-center justify-between [transform-style:preserve-3d]">
      {/* 3 Spec Boxes (Tone 2 Surface, No Border, Z: 110px) */}
      <div className="w-full [transform-style:preserve-3d] grid grid-cols-3 gap-2">
        <div className="flex flex-col items-center gap-1.5 p-3 rounded-xl bg-muted/60 [transform:translateZ(90px)] [transform-style:preserve-3d]">
          <div className="p-2 rounded-lg bg-card text-primary shadow-xs">
            <Clock className="size-5" />
          </div>
          <p className="text-xs font-bold tracking-tight text-foreground">{hours}</p>
          <span className="text-[10px] text-muted-foreground font-medium">Durasi Video</span>
        </div>

        <div className="flex flex-col items-center gap-1.5 p-3 rounded-xl bg-muted/60 [transform:translateZ(105px)] [transform-style:preserve-3d]">
          <div className="p-2 rounded-lg bg-card text-primary shadow-xs">
            <Users className="size-5" />
          </div>
          <p className="text-xs font-bold tracking-tight text-foreground">{tutorSessions}</p>
          <span className="text-[10px] text-muted-foreground font-medium">Bimbingan</span>
        </div>

        <div className="flex flex-col items-center gap-1.5 p-3 rounded-xl bg-muted/60 [transform:translateZ(90px)] [transform-style:preserve-3d]">
          <div className="p-2 rounded-lg bg-card text-primary shadow-xs">
            <Award className="size-5" />
          </div>
          <p className="text-xs font-bold tracking-tight text-foreground">{benefits}</p>
          <span className="text-[10px] text-muted-foreground font-medium">Portofolio</span>
        </div>
      </div>

      {/* Description (Z: 70px) */}
      <div className="space-y-2 [transform-style:preserve-3d] px-2 text-center my-auto">
        <h4 className="text-base font-bold tracking-tight text-foreground [transform:translateZ(70px)]">
          Fasilitas &amp; Benefit Kursus
        </h4>
        <p className="text-xs font-medium text-muted-foreground leading-relaxed [transform:translateZ(40px)]">
          {description}
        </p>
      </div>

      {/* Action Button (Z: 85px) */}
      <div className="w-full [transform-style:preserve-3d]">
        <a
          href={href}
          className="h-11 w-full rounded-xl bg-primary text-primary-foreground text-xs font-bold tracking-wider shadow-lg shadow-primary/25 transition-all hover:bg-primary/90 hover:scale-[1.02] active:scale-95 flex items-center justify-center gap-1.5 [transform:translateZ(85px)] text-decoration-none"
        >
          <Zap className="size-3.5 fill-current" />
          <span>Daftar Sekarang ({price})</span>
        </a>
      </div>
    </div>
  );

  return <PerspectiveFlipCard front={front} back={back} />;
}

export default CoursePerspectiveCard;
